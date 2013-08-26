<?php
/************************************************
 *                                         
 *  Qualizone Automation System © 2013
 * ********************************************* 
 * ICT Director: Dr. Ayman Dayekh
 * Developed by: Jamil M. Abdallah, Malak Chaib              
 *  File name:  auth.php
 *  Date created: Jun 6, 2013
 * ********************************************* 
 *  page that should be included for all the 
 *  admin protected pages, Super admins get
 *  clear pass to anything. you should set the actions
 *  required for a page prior to including this section
 * ********************************************* 
 * http://www.qualizone-lb.com/
 * 3rd Floor – Al-Sahel Center – Airport Blvd
 * Beirut – Lebanon
 * Office: +961 (1) 82 55 74
 * Email: info@qualizone-lb.com
 *************************************************/
if (!$user )
{ 
	$auth->deny();
}
else
{ 		
	if (!$auth->isSuper())
	{
		// if this is not a super user and this page got some action then he will be checked if he have access to it or not
		if(isset($actions))
		{
			$allowed = false; 
			$auth->loadRoleActions(); 
			foreach ( $actions as $action)
			{
				$allowed =false;
				if($auth->canDo($action))
				{
					$allowed = true;
					break;
				}
			}
			if (!$allowed) $auth->deny();
		}
	}
}