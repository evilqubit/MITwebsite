<?php
/**
 * Newsletter Module 2
 * @author AB
 * @version 2.6.0 20120328
 */
class NewsletterModule extends CWebModule
{
    /**
     * Enable the subscription form in the default controller
     * @var boolean 
     */
    public $enableSubscriptionForm = false;
    
    /**
     * Enable user to unsubscribe
     * @var boolean 
     */
    public $enableUnsubscription = true;
    
    /**
     * Enable the unsubscription form in the default controller
     * @var boolean 
     */
    public $enableUnsubscriptionForm = false;
    
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'newsletter.models.*',
			'newsletter.components.*',
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
