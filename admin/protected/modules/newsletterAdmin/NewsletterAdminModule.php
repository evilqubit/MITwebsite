<?php
/**
 * Newsletter Admin Module
 * @author AB
 * @package Newsletter Module 2
 */
class NewsletterAdminModule extends CWebModule
{
    /**
     * Display template drop down list in the send newsletter form.
     * @var boolean 
     */
    public $displayTemplates = false;
    /**
     * Enbale the admin to choose the sending time of the newsletter
     * @var boolean
     */
    public $schedule = true;
    
    /**
     * Enable editing subscribers info from the backend
     * @var boolean
     */
    public $backendUpdateSubscriber = true;
    
    /**
     * Enable deleting subscribers from the backend
     * @var boolean
     */
    public $backendDeleteSubscriber = true;
    
    /**
     * Enable adding subscribers from the backend
     * @var boolean
     */
    public $backendAddSubscriber = true;
    
    /**
     * Enable importing subscribers from the backend
     * @var boolean
     */
    public $backendImportSubscriber = true;
    
    /**
     * Enable exporting subscribers from the backend
     * @var boolean
     */
    public $backendExportSubscriber = true;
    
    /**
     * If we're using amailer and saving emails to DB
     * @var boolean
     */
    public $usingMailEngine = true;
    
    /**
     * Enable groups of subscribers
     * @var boolean
     */
    public $enableGroups = false;
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'newsletterAdmin.models.*',
			'newsletterAdmin.components.*',
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
