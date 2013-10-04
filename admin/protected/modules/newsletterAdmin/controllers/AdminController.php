<?php

/**
 * Admin Controller, backend actions: send, schedule, list...
 * @package Newsletter Module
 */
class AdminController extends AAdminController{

    /**
     * Display list of all newsletters
     */
    public function actionIndex(){
        $model = new NewsletterHistory('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['NewsletterHistory']))
            $model->attributes = $_GET['NewsletterHistory'];
        $this->render('index', array(
            'model'=>$model,
        ));
    }

    /**
     * Newsletter detail page
     * @param integer $id newsletter id
     */
    public function actionDetail($id){
        $model = NewsletterHistory::model()->loadModel($id);
        $mails = array();
        if($this->module->usingMailEngine){
            $mails = new MailQueue('search');
            $mails->unsetAttributes();  // clear any default values
            if(isset($_GET['MailQueue']))
                $mails->attributes = $_GET['MailQueue'];
        }
        
			  $mailMessage = MailMessage::model()->findByAttributes(array("referenceId"=> $id)); 
        $this->render('detail', array(
            'model'=>$model,
            'mails'=>$mails,
            'mailMessage'=>$mailMessage,
        
        ));
    }

    /**
     * Activate MailQueue Model
     * used in detail view in ajax call in order to activate MailQueue modle
     * @param int $id  model id
     */
    public function actionQueueactivate($id){
        if(Yii::app()->request->isPostRequest){
            // we only allow activation via Post request
            $model = MailQueue::model()->loadModel($id);
            $model->activate();
            $model->save(false);
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }
    
   

    /**
     * Action to display and process a Form to Submit newsletter
     */
    public function actionSend(){
        $model = new NewsletterHistory('send');
        if(isset($_POST['NewsletterHistory'])){
        	
        	 
        	  $_POST['NewsletterHistory']["text"] = 
        	  '
        	  
        	  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<table width="500px" style="background:#03648A">
	<tr>
    	<td colspan="3" ><img src="http://abdali.jo/email/abdali-logo2.png" style="padding:5px;"/></td>
    </tr>
    <tr>
    	<td width="10px">&nbsp;</td>
        <td >
        	<table >
            	<tr>
                	<td style="padding-top:5px; border-top:1px dashed #dedede;color:#fff;">
                    	<p>
                       '.$_POST['NewsletterHistory']["text"].'
                        
                        </p>
                    
                    </td>
                </tr>
            </table>	
        </td>
        <td width="10px">&nbsp;</td>
    </tr>
    <tr>
    	<td height="10px"></td>
    </tr>
</table>

<body>
</body>
</html>


        	  
        	  ';
        	  
            $model->attributes = $_POST['NewsletterHistory'];
            if($model->validate()){
                if($model->save(false)){
                    // If enableGroups parameter in module is set to true
                    if($this->module->enableGroups){
                        if(isset($_POST['groups'])){
                            $connection = Yii::app()->db;
                            foreach($_POST['groups'] as $group){
                                $id = (int) $group;
                                $sql = "INSERT INTO newsletter_history_group(newsletterId, groupId) VALUES($model->id, $id)";
                                $command = $connection->createCommand($sql);
                                $command->execute();
                            }
                        }
                    }
                    $this->redirect(array('schedule', 'id'=>$model->id));
                }
            }
        }
        $this->render('send', array('model'=>$model));
    }

    /**
     * Action to update newsletter
     */
    public function actionUpdate($id){
        $model = NewsletterHistory::model()->loadModel($id);
    
        if($model->sendingTime != '0000-00-00 00:00:00'){
            throw new CHttpException(404, 'Newsletter Already Scheduled');
        }
        /* hazihi la taslo7 3ala al hq2
        if(strtotime($model->sendingTime) > 0){ //If already scheduled, no need to update
            throw new CHttpException(404, 'Newsletter Already Scheduled');
        }*/
        if(isset($_POST['NewsletterHistory'])){
            $model->attributes = $_POST['NewsletterHistory'];
            if($model->validate()){
                if($model->save(false)){
                    $this->redirect(array('schedule', 'id'=>$model->id));
                }
            }
        }
        $this->render('update', array('model'=>$model));
    }

    /**
     * Action to preview, send test mail, schedule and send newsletter
     * @param integer $id  newsletter history Id
     */
    public function actionSchedule($id){
        $model = NewsletterHistory::model()->loadModel($id);
        if($model->sendingTime != '0000-00-00 00:00:00'){
            throw new CHttpException(404, 'Newsletter Already Scheduled');
        }
        // For sending test email
        $testNewsletterModel = new TestNewsletterForm;
        if(isset($_POST['TestNewsletterForm'])){
            $testNewsletterModel->attributes = $_POST['TestNewsletterForm'];
            if($testNewsletterModel->validate()){
                $email = Yii::app()->email->load();
                $email->Subject = "(test) ".$model->title;
                $email->MsgHTML($model->bodyWithTemplate());
                $email->AddAddress($testNewsletterModel->email);
                if($email->send(true)){
                    Yii::app()->user->setFlash('message', 'Testing email sent successfully.');
                    $this->redirect($this->createUrl('schedule', array('id'=>$id)));
                }
            }
        }
        // For schedule and send newsletter
        $scheduleModel = new ScheduleForm;
        $time = new CDbExpression('NOW()');
        $scheduleValidated = false;
        if(isset($_POST['ScheduleForm'])){
            $scheduleModel->attributes = $_POST['ScheduleForm'];
            if($scheduleValidated = $scheduleModel->validate()){
                $time = TimeHelper::MysqlDateFormat(strtotime($scheduleModel->time));
            }
        }
        if($scheduleValidated || isset($_POST['sendNow'])){
            $model->sendingTime = $time;
            $count = $model->sendNewsletter();
            $model->save(false);
            Yii::app()->user->setFlash('message', "Newsletter will be sent to $count subscriber.");
            $this->redirect($this->createUrl('detail', array('id'=>$model->id)));
        }
        $this->render('schedule', array(
            'model'=>$model,
            'testNewsletterModel'=>$testNewsletterModel,
            'scheduleModel'=>$scheduleModel,
        ));
    }

    /**
     * Publish assets for date time picker jquery plugin
     */
    public function publishDateTimePickerAssets(){
        $assets = dirname(__FILE__).'/../assets';
        if(is_dir($assets)){
            $baseUrl = Yii::app()->assetManager->publish($assets);
            $clientScript = Yii::app()->clientScript;
            $clientScript->registerCoreScript('jquery.ui');
            $clientScript->registerCssFile($baseUrl.'/jquery-ui-1.8.16.custom.css');
            $clientScript->registerCss('timepickerCss', '/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }');
            $clientScript->registerScriptFile($baseUrl.'/jquery-ui-timepicker-addon.js');
        }
        else{
            throw new Exception('DateTime Picker - Error: Couldn\'t find assets to publish.');
        }
    }

    
    public function actionStopMail($id)
    {
			        
					$criteria=new CDbCriteria(array(
						                    'condition' => "referenceId=".$id,
						                   )); 
			    $mails = MailMessage::model()->find($criteria); 
			    $mail = MailMessage::model()->findByAttributes(array("referenceId"=> $id)); 
			    $mail->active = 0;
			   	$mail->save(false);
			   	 $this->redirect($this->createUrl('detail', array('id'=>$id)));
			   	 
    }
    
    public function actionActivateMail($id)
    {
			        
					$criteria=new CDbCriteria(array(
						                    'condition' => "referenceId=".$id,
						                   )); 
			    $mails = MailMessage::model()->find($criteria); 
			    $mail = MailMessage::model()->findByAttributes(array("referenceId"=> $id)); 
			    $mail->active = 1;
			   	$mail->save(false);
			   	$this->redirect($this->createUrl('detail', array('id'=>$id)));
    }

}