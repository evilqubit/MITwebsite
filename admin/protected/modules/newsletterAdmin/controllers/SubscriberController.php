<?php

/**
 * Subscriber Controller, contains subscriber crud actions
 */
class SubscriberController extends BAdminController{

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id){
        $this->render('view', array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate(){
        if(!$this->module->backendAddSubscriber){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $model = new NewsletterSubscriber;
        $model->scenario = 'backend';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['NewsletterSubscriber'])){
            $model->attributes = $_POST['NewsletterSubscriber'];
            $model->source = 1;
            if($model->save()){
                if($this->module->enableGroups){
                    $groupsArray = array();
                    if(isset($_POST['NewsletterSubscriber']['groups'])){
                        $groupsArray = $_POST['NewsletterSubscriber']['groups'];
                    }
                    $model->saveMany('groups',$groupsArray);
                }
                $this->redirect(array('view', 'id'=>$model->id));
            }
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
        if(!$this->module->backendUpdateSubscriber){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $model = $this->loadModel($id);
        $model->scenario = 'update';
        $oldEmail = $model->email;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['NewsletterSubscriber'])){
            $model->attributes = $_POST['NewsletterSubscriber'];

            if($model->email != $oldEmail){
                $model->scenario = 'backend';
            }
            if($model->save()){
                if($this->module->enableGroups){
                    $groupsArray = array();
                    if(isset($_POST['NewsletterSubscriber']['groups'])){
                        $groupsArray = $_POST['NewsletterSubscriber']['groups'];
                    }
                    $model->saveMany('groups',$groupsArray);
                }
                $this->redirect(array('view', 'id'=>$model->id));
            }
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
        if(!$this->module->backendDeleteSubscriber){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        if(Yii::app()->request->isPostRequest){
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

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
        $model = new NewsletterSubscriber('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['NewsletterSubscriber']))
            $model->attributes = $_GET['NewsletterSubscriber'];

        $this->render('admin', array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id){
        $model = NewsletterSubscriber::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model){
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'newsletter-subscriber-form'){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Action used to import subscribers from excel file
     */
    public function actionImport(){
        if(!$this->module->backendImportSubscriber){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $model = new ImportForm;
        if(isset($_POST['ImportForm'])){
            $model->attributes = $_POST['ImportForm'];
            $file = CUploadedFile::getInstance($model, 'file');
            $model->file = $file;
            if($model->validate()){
                $txt = file_get_contents($file->getTempName());
                $subscribers = Excel::allRows($file->getTempName());
                $count = 0;
                foreach($subscribers as $subscriber){
                    $sub = new NewsletterSubscriber('import');
                    $sub->email = $subscriber[0];
                    if(isset($subscriber[1]))
                        $sub->firstName = $subscriber[1];
                    if(isset($subscriber[2]))
                        $sub->lastName = $subscriber[2];
                    $sub->source = 2;
                    if($sub->save()){
                        $count++;
                    }
                }
                Yii::app()->user->setFlash('message', "$count new subscriber added");
                $this->redirect(array('index'));
            }
        }
        $this->render('import', array(
            'model'=>$model,
        ));
    }

    /**
     * Action used to export subscribers to excel file
     */
    public function actionExport(){
        if(!$this->module->backendExportSubscriber){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $models = NewsletterSubscriber::model()->active()->findAll();

        $array = array();
        // Set Header
        $array[] = array(
            NewsletterSubscriber::model()->getAttributeLabel('email'),
        );
        foreach($models as $model){
            $array[] = array(
                $model->email,
            );
        }
        Excel::export($array);
    }

}
