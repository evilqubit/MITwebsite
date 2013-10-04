<?php

/**
 * TestNewsletterForm class.
 * used by the 'schedule' action of 'AdminController'.
 * @package newsletter module
 */
class TestNewsletterForm extends CFormModel{

    public $email;

    /**
     * Declares the validation rules.
     */
    public function rules(){
        return array(
            array('email', 'required'),
            array('email', 'email'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels(){
        return array(
            'email'=>'Email',
        );
    }

}