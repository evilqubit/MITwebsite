<?php

/**
 * BAciveRecord
 * extends AActiveRecord to take care of active, deleted, ordering fields
 *
 * @author AB
 * @version $Id: BActiveRecord.php v2-2-20120224
 */
abstract class BActiveRecord extends AActiveRecord{

    /**
     * If ordering field is available in the table
     * @var boolean 
     */
    protected $enableOrdering = true;

    /**
     * Default Scope: returns rows order by 'ordering DESC' first then by 'time DESC'
     */
    public function defaultScope(){
        $alias = $this->getTableAlias(false, false);
        if($this->enableOrdering){
            $order = "$alias.ordering ASC, $alias.cTime DESC";
        }
        else{
            $order = "$alias.cTime DESC, $alias.id DESC";
        }

        return array(
            'condition'=>"$alias.deleted = 0",
            'order'=>$order,
        );
    }

    /**
     * Usage: ModelName::model()->active()->findAll();
     */
    public function scopes(){
        $alias = $this->getTableAlias();
        return array(
            'active'=>array(
                'condition'=>$alias.'.active = 1',
            ),
            'deleted'=>array(
                'condition'=>$alias.'.deleted = 1',
            ),
        );
    }

    /**
     * Scope with parameter, default order by 'ordering DESC'
     * Usage: ModelName::model()->reverseOrder()->findAll();
     *
     * @param   bool  if ordering in ascending
     */
    public function reverseOrder($asc = true){
        $type = ($asc) ? 'asc' : 'desc';
        $this->getDbCriteria()->mergeWith(array(
            'order'=>'ordering '.$type.', cTime DESC',
        ));
        return $this;
    }

    /**
     * Activate or deactivate model
     */
    public function activate(){
        if($this->active === '1')
            $this->active = '0';
        else
            $this->active = '1';
        return $this->active;
    }

    /**
     * Return on or off message accroding to active dield
     */
    public function activateImage(){
        if($this->active === "1")
            return 'images/be/button-active-on.png';
        else
            return 'images/be/button-active-off.png';
    }

    /**
     * returns activate/deactivate button for CGridView
     * 
     * @param string  CGridView Id
     * @param string  activate url prefix if CGridView is in different controller
     * @return array  CGridView Column Array - Activate/Deactivate Button
     */
    public static function activateButton($gridId, $activateUrl = ''){
        return array(
            'header'=>'Activate',
            'class'=>'CButtonColumn',
            'template'=>'{activate}{deactivate}',
            'buttons'=>array(
                'activate'=>array
                    (
                    'imageUrl'=>'images/be/button-active-off.png',
                    'url'=>'Yii::app()->controller->createUrl("'.$activateUrl.'activate",array("id"=>$data->id))',
                    'click'=>"
							function() {
							$.fn.yiiGridView.update('{$gridId}', {
								type:'POST',
								url:$(this).attr('href'),
								success:function(data) {
									$.fn.yiiGridView.update('{$gridId}');
								}
							});
							return false;
							}",
                    'visible'=>'!$data->active',
                ),
                'deactivate'=>array
                    (
                    'imageUrl'=>'images/be/button-active-on.png',
                    'url'=>'Yii::app()->controller->createUrl("'.$activateUrl.'activate",array("id"=>$data->id))',
                    'click'=>"
							function() {
							$.fn.yiiGridView.update('{$gridId}', {
								type:'POST',
								url:$(this).attr('href'),
								success:function(data) {
									$.fn.yiiGridView.update('{$gridId}');
								}
							});
							return false;
							}",
                    'visible'=>'$data->active',
                )
            )
        );
    }

    /**
     * Overrides the original delete function
     * Soft Deletes the row corresponding to this active record. (deleted=1)
     * 
     * @return boolean whether the deletion is successful.
     * @throws CException if the record is new
     */
    public function delete(){
        if(!$this->getIsNewRecord()){
            Yii::trace(get_class($this).'.delete()', 'models.BActiveRecord');
            if($this->beforeDelete()){
                $this->deleted = 1;
                $result = $this->save(false);
                $this->afterDelete();
                return $result;
            }
            else
                return false;
        }
        else
            throw new CDbException(Yii::t('yii', 'The active record cannot be deleted because it is new.'));
    }

}