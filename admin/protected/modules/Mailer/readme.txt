Dependencies:
* Custom Active Records V2 (AActive Records, BActive Records)
* Custom Controllers from Components (AAdminController, BAdminController)
* Amailer component with scheduler property = true

Usage:
1- Import DB.
2- Copy mailer folder to protected/modules
3- Add to configuration (main.php):
	* 'application.modules.mailer.models.*', 
	in import array
	* 'mailer',
	in modules array.
	or with parameters:
	'mailer'=>array(
            'hash'=>'myhash',
        ),