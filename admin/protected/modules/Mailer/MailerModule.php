<?php
/**
 * Mailer Module
 * Used when saving Mails in DB using amailer
 * Displays messages and mails + 
 * contains cron jobs action needed to send emails from DB
 * @author AB
 * @version 1.1 20120430
 */
class MailerModule extends CWebModule
{
    /**
     * verification hash used in cron-job acrion
     * @var string
     */
    public $hash = "ab2asqw";
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'mailer.models.*',
			'mailer.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
