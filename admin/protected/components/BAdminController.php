<?php
/**
 * BAdminController extends AAdminController class.
 * adds common functions for admin of BActiveRecord Model, like actionActivate
 * 
 * @author AB
 * @version $Id: BAdminController.php 2 2011-10-24
 */
class BAdminController extends AAdminController
{
    
    /**
	 * Activate a particular model.
	 * @param integer $id the ID of the model to be activated
	 */
	public function actionActivate($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow activation via Post request
			$model = $this->loadModel($id);
			$model->activate();
			$model->save(false);	
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
}