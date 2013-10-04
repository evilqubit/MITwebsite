<?php
/**
 * Default Controller, contains front end actions
 * @package newsletter module
 */
class DefaultController extends Controller{

    public function actionIndex(){
        throw new CHttpException(404, 'The requested page does not exist.');
    }

    /**
     * Subscribe Form
     */
    public function actionSubscribe(){
        // Disable the access to the form accrding to 'enableSubscriptionForm' parameter
        if(!$this->module->enableSubscriptionForm){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $model = new NewsletterSubscriber('subscribe');
        if(isset($_POST['NewsletterSubscriber'])){
            $model->attributes = $_POST['NewsletterSubscriber'];
            if($model->validate()){
                if($model->save(false)){
                    Yii::app()->user->setFlash('message', 'Thank you for registering for our newsletter.');
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : Yii::app()->homeUrl);
                }
            }
        }
        $this->render('subscribe', array('model'=>$model));
    }

    /**
     * Unsubscribe Form
     */
    public function actionUnsubscribe(){
        // Disable the access to the form accrding to 'enableSubscriptionForm' parameter
        if(!$this->module->enableUnsubscription || !$this->module->enableUnsubscriptionForm){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $model = new NewsletterSubscriber('unsubscribe');
        if(isset($_POST['NewsletterSubscriber'])){
            $model->attributes = $_POST['NewsletterSubscriber'];
            if($model->validate()){
                $subscriber = NewsletterSubscriber::model()->find('email=:email AND deleted=0 AND unsubscribed=0', array(':email'=>$model->email));
                if($subscriber->sendUnsubscriptionEmail()){
                    Yii::app()->user->setFlash('message', 'An email will be sent to you in order to validate your unsubscription.');
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : Yii::app()->homeUrl);
                }
            }
        }
        $this->render('unsubscribe', array('model'=>$model));
    }

    /**
     * action to validate the unsubscription of a user
     * @param type $id newsletter subscriber id
     * @param type $hash newsletter subscriber hash
     */
    public function actionValidateUnsubscription($id, $hash){
        $model = NewsletterSubscriber::model()->loadModel($id);
        if($model->unsubscribe($hash)){
            Yii::app()->user->setFlash('message', 'You have been unsubscribed from the newsletter.');
            $this->redirect(Yii::app()->homeUrl);
        }
    }

}