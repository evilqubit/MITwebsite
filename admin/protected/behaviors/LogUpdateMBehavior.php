<?php

/**
 * Log Update Model Behavior
 * Added as behavior to Model class
 * used to log the update of models in db: uUserId, uTime, uIpAddress
 * Usage:<br>
 * 'logUpdate'=>array(
                'class'=>'LogUpdateMBehavior',
                )
 * @author AB
 * @version 2-20120117
 */
class LogUpdateMBehavior extends CActiveRecordBehavior{

    /**
     * Log User Id,
     * uUserId should be available in the table
     * @var boolean 
     */
    public $logUserId = true;

    /**
     * Log update time,
     * uTime should be available in the table
     * @var boolean 
     */
    public $logTime = true;

    /**
     * Log IP address of the user,
     * uIpAddress should be available in the table
     * @var boolean 
     */
    public $logIpAddress = true;

    /**
     * called when behavior is attached
     * @param CComponent $owner 
     */
    public function attach($owner){
        parent::attach($owner);
    }

    /**
     * Responds to {@link CModel::onBeforeSave} event.
     * Sets the values of the update: time, IP address, user Id attributes as configured
     *
     * @param CModelEvent $event event parameter
     */
    public function beforeSave($event){
        $model = $this->getOwner(); 
        if($this->logUserId){
            $user = Yii::app()->user;
            $model->uUserId = $user->id;
        }
        if($this->logTime){
            $model->uTime = new CDbExpression('NOW()');
        }
        if($this->logIpAddress){
            $model->uIpAddress = $_SERVER['REMOTE_ADDR'];
        }
        return parent::beforeSave($event);
    }

}