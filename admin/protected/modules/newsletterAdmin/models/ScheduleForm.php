<?php

/**
 * ScheduleForm class.
 * used by the 'schedule' action of 'AdminController'.
 * @package newsletter module
 */
class ScheduleForm extends CFormModel{

    public $id;
    public $time;

    /**
     * Declares the validation rules.
     */
    public function rules(){
        return array(
            array('time', 'required'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels(){
        return array(
            'time'=>'Time',
        );
    }

}