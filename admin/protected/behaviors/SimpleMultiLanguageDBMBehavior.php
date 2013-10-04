<?php

/**
 * Simple Multi Language DB Behavior for Models
 * used in models that supports multi language in the same row (ex: titleAr, titleEn)
 * Usage:<br>
  'SimpleMultiLanguageDB'=>array(
  'class'=>'SimpleMultiLanguageDBMBehavior',
  )
 * @author AB
 * @version 1-20120320
 */
class SimpleMultiLanguageDBMBehavior extends CActiveRecordBehavior{

    /**
     * returns the attribute in right language
     * usage: $model->attrT('title'); //returns $model->titleEn
     * @param string $attr
     * @return string
     */
    public function attrT($attr, $lang=''){
        $owner = $this->getOwner();
        if(!$lang)
            $lang = Yii::app()->language;
        $attr .= ucfirst(Yii::app()->language);
        $ret = $owner->$attr;
        return $ret;
    }

}