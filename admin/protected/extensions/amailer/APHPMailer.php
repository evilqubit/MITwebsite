<?php

/**
 * APHPMailer class extends PHPMailer
 * adds the custom send method: save to database. 
 */
require_once('PHPMailer'.DIRECTORY_SEPARATOR.'class.phpmailer.php');

class APHPMailer extends PHPMailer{

    /**
     * if send directly, or saved to db
     * set in the constructor
     * @var boolean 
     */
    protected $directSend = true;

    /**
     * sending time schedule
     * @var string 
     */
    public $sendingTime = NULL;

    /**
     * Reference Id
     * could be used as foreign key
     * @var id 
     */
    public $referenceId = 0;

    public function __construct($exceptions = false, $directSend = true){
        parent::__construct($exceptions);
        $this->directSend = ($directSend == true);
    }

    /**
     * Send Email, override the function from PHPMailer,
     * in order to add the ability to schedule and save messages in db
     * @param type $bypassDB  if true, send directly
     * @return booleam  Sent or not
     */
    public function Send($bypassDB = false){
        if(!$this->directSend && !$bypassDB){
            $message = new MailMessage;
            $message->title = $this->Subject;
            $message->body = $this->Body;
            if($this->ContentType == 'text/html'){
                $message->isHtml = 1;
            }
            else{
                $message->isHtml = 0;
            }
            if($this->sendingTime){
                $message->sendingTime = $this->sendingTime;
            }
            else{
                $message->sendingTime = new CDbExpression('NOW()');
            }
            $message->from = $this->From;
            $message->fromName = $this->FromName;
            $message->referenceId = $this->referenceId;
            $error = true;
            if($message->save(false)){
                $error = false;
                // Merge all recipients
                $recipients = array_merge($this->to, $this->cc, $this->bcc);
                foreach($recipients as $recipient){
                    $queue = new MailQueue;
                    $queue->to = $recipient[0];
                    $queue->toName = $recipient[1];
                    $queue->messageId = $message->id;
                    if(!$queue->save(false)){
                        $error = true;
                    }
                }
            }
            return !$error;
        }
        else{
            return parent::Send();
        }
    }

}
