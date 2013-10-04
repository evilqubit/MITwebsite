<?php

class DefaultController extends AAdminController{

    /**
     * Mail Messages List
     */
    public function actionIndex(){
        $this->redirect($this->createUrl('message/index'));
    }

    /**
     * Send First $number of emails in the queue
     * @param string $hash  security hash, should be same as $this->module->hash
     * @param integer $number number of messages to send every time
     */
    public function actionCron($hash, $number=15){
        if($hash == $this->module->hash){
            $connection = Yii::app()->db;
            $sql = "SELECT q.id FROM mail_queue as q, mail_message as m WHERE q.messageId=m.id AND m.active = 1 AND m.deleted = 0 AND q.active = 1 and q.deleted = 0 AND (q.status = 0 OR q.status = -1) AND m.sendingTime < NOW() ORDER BY q.status DESC, m.sendingTime ASC limit 0,$number";
            $command = $connection->createCommand($sql);
            $ids = $command->queryColumn();
            foreach($ids as $id){
                $queue = MailQueue::model()->findByPk($id);
                if($queue){
                    $email = Yii::app()->email->load();
                    $email->clearAllRecipients();
                    $message = $queue->message;
                    $email->Subject = $message->title;
                    $email->MsgHTML($message->body);
                    $email->From = $message->from;
                    $email->FromName = $message->fromName;
                    $email->AddAddress($queue->to);
                    if($email->send(true)){
                        $status = 1;
                        $error='';
                    }
                    else{
                        $status = -1;
                        $error = $email->ErrorInfo;
                    }
                    $queue->status = $status;
                    $queue->error = $error;
                    $queue->save(false);
                }
            }
        }
    }

}