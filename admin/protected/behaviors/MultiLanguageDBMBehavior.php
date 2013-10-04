<?php

/**
 * Multi Language DB Behavior for Models
 * used in models that supports mulit-language
 * Usage:<br>
  'MultiLanguageDB'=>array(
  'class'=>'application.behaviors.MultiLanguageDBMBehavior',
  )
 * @author AB
 * @version 4-20120320
 */
class MultiLanguageDBMBehavior extends CActiveRecordBehavior{

    /**
     * Scope with parameter, select models with specific language only
     * Usage: ModelName::model()->lang()->findAll();
     * @param  lang  language to be selected
     */
    public function lang($lang = ''){
        if(!$lang)
            $lang = Yii::app()->language;
        $owner = $this->getOwner();
        $alias = $owner->getTableAlias();
        $owner->getDbCriteria()->mergeWith(array(
            'condition'=>"$alias.lang = '$lang'",
        ));
        return $owner;
    }

    /**
     * If attribute is not empty return it, else returns parent's attribute
     * Used in multi language models
     * @param string $attr
     * @return string
     */
    public function attrT($attr){
        $owner = $this->getOwner();
        if($owner->$attr){
            $ret = $owner->$attr;
        }
        else{
            $ret = $owner->parent->$attr;
        }
        return $ret;
    }

    /**
     * returns parent's attribute or parent model if attribute is not specified
     * @param string $attr
     * @return string
     */
    public function parentT($attr=''){
        $owner = $this->getOwner();
        if(!$attr){
            if($owner->parentId){
                $ret = $owner->parent;
            }
            else{
                $ret = $owner;
            }
        }
        else{
            if($owner->parentId){
                $ret = $owner->parent->$attr;
            }
            else{
                $ret = $owner->$attr;
            }
        }
        return $ret;
    }

    /**
     * returns model with right language
     * @param string $lang
     * @return Object 
     */
    public function modelT($lang = ''){
        $owner = $this->getOwner();
        if(!$lang)
            $lang = Yii::app()->language;
        if(!$owner->parentId && $owner->lang != $lang){ //if parent and different lang
            if($model = $owner->translation){
                return $model;
            }
        }
        return $owner;
    }

    /**
     * Getter for language name
     * @return string 
     */
    public function getLanguageName(){
        $languages = Yii::app()->params['languages'];
        return $languages[$this->getOwner()->lang];
    }

    /**
     * Returns HTML string for model's buttons (edit, delete)
     * @return string
     */
    public function buttons(){
        $owner = $this->getOwner();
        $updateUrl = Yii::app()->controller->createUrl('update', array('id'=>$owner->id));
        $deleteLink = CHtml::link('<img src="images/be/delete.png" title="delete" />', '#', array('submit'=>array('delete', 'id'=>$owner->id), 'confirm'=>'Are you sure you want to delete this item?'));
        $str = <<<EOA
   <div style="float:right">
        <a href="$updateUrl"><img src="images/be/update.png" title="update" /></a>
        $deleteLink
        </div>
EOA;
        return $str;
    }

    /**
     * Returns array of remaining languages; languages with no translation.
     * @return array
     */
    public function remainingLanguages(){
        $owner = $this->getOwner();
        $languages = Yii::app()->params['languages'];
        if($owner->parentId)
            $parent = self::model()->loadModel($owner->parentId);
        else
            $parent = $owner;
        unset($languages[$parent->lang]);
        foreach($parent->children as $child){
            unset($languages[$child->lang]);
        }
        return $languages;
    }

    /**
     * Delete children if parent
     */
    public function afterDelete($event){
        $owner = $this->getOwner();
        if(!$owner->parentId){
            foreach($owner->children as $child){
                $child->delete();
            }
        }
        return parent::afterDelete($event);
    }

}