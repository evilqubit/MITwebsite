<?php
/**
 * AAciveRecord
 * extends CActiveRecord to automatically add cTime and cIpAddress and cUserId to AR
 *
 * @author AB
 * @version $Id: AActiveRecord.php v2-1-20120117
 */
 
abstract class AActiveRecord extends CActiveRecord
{
    /**
     * Log IP address of creator, Can be overridden in sub classes models
     * cIpAddress should be available in the table
     * @var boolean 
     */
    protected $logIpAddress = true;
    
    /**
     * Log User Id, Can be overridden in sub classes models
     * cUserId should be available in the table
     * @var boolean 
     */
    protected $logUserId = false;
	
	/**
	 * Prepares time,ipAddress attributes before saving.
	 */
	protected function beforeSave(){
		if($this->isNewRecord){
			$this->cTime = new CDbExpression('NOW()');
            if($this->logIpAddress){
                $this->cIpAddress = $_SERVER['REMOTE_ADDR'];
            }
            if($this->logUserId){
                $user = Yii::app()->user;
                $this->cUserId = $user->id;
            }
		}
		return parent::beforeSave();
	}
	
	/**
	 * Default scope, returns rows order by 'time DESC'
	 */
	public function defaultScope()
    {
		$alias = $this->getTableAlias( false, false );
        return array(
			'order'=>"$alias.cTime DESC, $alias.id DESC",
        );
    }
	
	/**
	 * Scope with parameter, default order by 'time DESC'
	 * Usage: ModelName::model()->reverseOrder()->findAll();
	 *
	 * @param   bool  if ordering in ascending
	 */	
	public function reverseOrder($asc = true)
	{
		$type = ($asc) ? 'asc' : 'desc'; 
		$this->getDbCriteria()->mergeWith(array(
			'order'=>'cTime '.$type,
		));
		return $this;
	}
	
	
	/**
	 * Return Model if exists, else throw exception
	 */
	public function loadModel($id)
	{
        $id = (int)$id;
		$model = $this->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
		
	}
	
}