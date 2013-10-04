<?php

/**
 * ImportForm class.
 * Used to import subscribers
 */
class ImportForm extends CFormModel{

    public $file;

    /**
     * Declares the validation rules.
     */
    public function rules(){
        $array = array(
            array('file', 'required'),
            array('file', 'file', 'allowEmpty' => true, 'types' => 'xlsx,xls'),
        );
        return $array;
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels(){
        $array = array(
            'file'=>Yii::t('main', 'File'),
        );
        return $array;
    }


}
