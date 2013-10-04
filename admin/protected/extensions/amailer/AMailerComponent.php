<?php

/**
 * AMailer Component
 * PHPMailer Wrapper Component
 *
 * @author AB
 * @version 1.2 6-20120430
 */
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'APHPMailer.php');

class AMailerComponent extends CApplicationComponent{

    /**
     * If sends email directly or save to DB and schedule it
     * @var boolean 
     */
    public $scheduler = false;

    /**
     * If debug is enabled in PHPMailer
     * @var boolean 
     */
    public $debug = false;

    /**
     * APHPMailer object
     * Used to call any PHPMailer function
     * @var APHPMailer 
     */
    public $mail = null;

    /**
     * SMTP Host
     * @var string
     */
    public $smtpHost = null;

    /**
     * SMTP Username
     * @var string
     */
    public $smtpUsername = null;

    /**
     * SMTP Password
     * @var string
     */
    public $smtpPassword = null;

    /**
     * From email or From as array, email and name
     * @var mixed
     */
    public $from = null;

    public function init(){
        parent::init();
        $mail = new APHPMailer($this->debug, !$this->scheduler);

        //If send from SMTP is enabled
        if($this->smtpHost && $this->smtpUsername && $this->smtpPassword){
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = $this->smtpHost;
            $mail->Username = $this->smtpUsername;
            $mail->Password = $this->smtpPassword;
        }

        //Process from
        if(!$this->from){
            if($this->smtpUsername){
                $from = $this->smtpUsername;
            }
            else{
                $from = Yii::app()->params['adminEmail'];
            }
            $fromName = '';
        }
        else{ //If $this->from is set
            if(is_array($this->from) && isset($this->from[0]) && isset($this->from[1])){
                $from = $this->from[0];
                $fromName = $this->from[1];
            }
            else{
                $from = $this->from;
                $fromName = '';
            }
        }
        $mail->SetFrom($from, $fromName);
        $mail->CharSet = 'UTF-8';
        $this->mail = $mail;
    }

    /**
     * clear all addresses and returns PHPMailer Object
     * @return APHPMailer
     */
    public function load(){
        $mail = $this->mail;
        $mail->ClearAllRecipients();
        return $mail;
    }

}
