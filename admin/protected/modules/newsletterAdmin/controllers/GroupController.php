<?php

class GroupController extends BAdminController{

    public function __construct($id, $module = null){
        parent::__construct($id, $module);
        if(!$this->module->enableGroups){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id){
        $model = $this->loadModel($id);

        $subscribers = new NewsletterSubscriberGroup('search');
        $subscribers->unsetAttributes();  // clear any default values
        if(isset($_GET['NewsletterSubscriberGroup']))
            $subscribers->attributes = $_GET['NewsletterSubscriberGroup'];
        $subscribers->groupId = $id;

        $this->render('view', array(
            'model'=>$model,
            'subscribers'=>$subscribers,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate(){
        $model = new NewsletterGroup;

        if(isset($_POST['NewsletterGroup'])){
            $model->attributes = $_POST['NewsletterGroup'];
            if($model->save())
                $this->redirect(array('view', 'id'=>$model->id));
        }

        $this->render('create', array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id){
        $model = $this->loadModel($id);

        if(isset($_POST['NewsletterGroup'])){
            $model->attributes = $_POST['NewsletterGroup'];
            if($model->save())
                $this->redirect(array('view', 'id'=>$model->id));
        }

        $this->render('update', array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id){
        if(Yii::app()->request->isPostRequest){
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            if($model->delete()){
                $sql = "DELETE FROM newsletter_subscriber_group WHERE groupId = $id";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql)->execute();
            }
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Deletes a NewsletterSubscriberGroup model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteSubscriber($id){
        if(Yii::app()->request->isPostRequest){
            // we only allow deletion via POST request
            $this->loadSubscriberModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionIndex(){
        $model = new NewsletterGroup('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['NewsletterGroup']))
            $model->attributes = $_GET['NewsletterGroup'];

        $this->render('index', array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id){
        $model = NewsletterGroup::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadSubscriberModel($id){
        $model = NewsletterSubscriberGroup::model()->findByPk($id);
        if($model === null){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model){
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'newsletter-group-form'){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Add multiple subscriber to a specific group
     * @param integer $id the ID of the model to be updated
     */
    public function actionAddMultiple($id){
        $model = $this->loadModel($id);

        if(isset($_POST['subscribers'])){
            $count = 0;
            foreach($_POST['subscribers'] as $subId){
                $m1 = new NewsletterSubscriberGroup;
                $m1->groupId = $model->id;
                $m1->subscriberId = $subId;
                if($m1->save(false))
                    $count++;
            }
            Yii::app()->user->setFlash('message', "$count subscribers added to this group.");
            $this->redirect(array('view', 'id'=>$model->id));
        }
        $subscribersArray = array();
        $subscribers = NewsletterSubscriber::model()->active()->subscribed()->findAll(array(
            'condition'=>"id NOT IN (SELECT DISTINCT(subscriberId) FROM newsletter_subscriber_group WHERE groupId = $model->id)",
                ));
        $subscribersArray = CHtml::listData($subscribers, 'id', 'email');
        $this->render('add-multiple', array(
            'model'=>$model,
            'subscribersArray'=>$subscribersArray,
        ));
    }

    /**
     * Remove multiple subscriber from a specific group
     * @param integer $id the ID of the model to be updated
     */
    public function actionRemoveMultiple($id){
        $model = $this->loadModel($id);
        if(isset($_POST['subscribers'])){
            $count = 0;
            foreach($_POST['subscribers'] as $subId){
                $m1 = $this->loadSubscriberModel($subId);
                if($m1->delete())
                    $count++;
            }
            Yii::app()->user->setFlash('message', "$count subscribers removed from this group.");
            $this->redirect(array('view', 'id'=>$model->id));
        }
        $subscribersArray = array();
        $subscribers = NewsletterSubscriberGroup::model()->with('subscriber')->findAll(array(
            'condition'=>"groupId = $model->id",
                ));
        foreach($subscribers as $subscriber){
            if($subscriber->subscriber){ //If subscriber not deleted
                $subscribersArray[$subscriber->id] = $subscriber->subscriber->email; 
            }
        }
        $this->render('remove-multiple', array(
            'model'=>$model,
            'subscribersArray'=>$subscribersArray,
        ));
    }

}
