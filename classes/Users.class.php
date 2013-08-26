<?php
/************************************************
 *                                         
 *  Qualizone Automation System © 2013
 * ********************************************* 
 * ICT Director: Dr. Ayman Dayekh
 * Developed by: Jamil M. Abdallah, Malak Chaib              
 *  File name:  Users.class.php
 *  Date created: Jun 6, 2013
 * ********************************************* 
 * Class that controls all users database activities
 *************************************************/
 
include_once '../include/connection.php';
include_once '../include/functions.php';
class Users extends Database
{	
	public function __construct() 
	{  
		$this->_table = "user";
		$this->_tableRoles = "role";
		$this->_key = "iduser";
		$this->_active = "active";
		$this->_deleted="deleted";
		$this->_lastAccess="lastAccess";
		$this->getInstance();
		
	}
	public function getById($id) 
	{   
		$sql = "select *  from $this->_table u
		left join user_roles  ur  on  iduser  = user_iduser
		left join roles r on roles_idroles = idroles
		where   iduser = '$id' ";
		$this->query($sql);
		return $this->fetch();
	}
	
	/** 
	gets the allowed tabs of a certain user
	ja: verified
	logic: admin gets to see all categores that have assigned actions and these actions got to have a page link
	 */
	public function getUserTabs($uerId , $admin = 0 , $parent=0)
	{
		if ($parent == 0)
		{
			$sql = " 
				SELECT distinct category.* from category
					where  category.active =1 and category.parent=0
			 ";
		}
		else
		if ($admin == 1)
		{ 
			/*
			$sql = " 
				SELECT distinct category.*
					FROM   action  
					LEFT JOIN category_action ON action.idaction = category_action.action_idaction
					LEFT JOIN category ON category_action.category_idcategory = category.idcategory
					where  action.active=1 and action.link<>'' and category.idcategory is not null
					and category.active =1 
			 ";
			 */
			$sql = " 
				SELECT distinct category.* from category
					where  category.active =1 and category.parent=$parent
			 ";
		}
		else
		{ 
			$sql = " 
				SELECT distinct category.*
					FROM user_roles
					LEFT JOIN roles on user_roles.roles_idroles = roles.idroles
					LEFT JOIN roles_action ON roles.idroles = roles_action.roles_idroles
					LEFT JOIN action ON action.idaction = roles_action.action_idaction
					LEFT JOIN category_action ON action.idaction = category_action.action_idaction
					LEFT JOIN category ON category_action.category_idcategory = category.idcategory
					where  ".($admin == 1 ? "" : "user_roles.user_iduser= '$uerId' and" )."  action.active=1 and action.link<>'' and roles.active=1 and category.idcategory is not null
					and category.active =1 and  category.parent=$parent
			
			 ";
		}
		$sql .=" order by category.order";
		return $this->query($sql);
	}
	
	
	
	public function listAll($condition= 1)
	{ 
		$and = $this->_showActive? " and u.active=1" : "";
		$and = !$this->_showDeleted? " and u.deleted=0" : "";
		$sql = "select u.*,r.title  from $this->_table u
		left join user_roles  ur  on  iduser  = user_iduser
		left join roles r on roles_idroles = idroles
		where $condition $and";
		$this->query($sql);
		if ($this->result)
		{
			return $this->fetchAll();
		}
		return null;		   
	}
	
	
	public function getUserActions($userId,$categoryId=0 , $admin =0)
	{  
		if ($admin ==1 )
		{
		$sql = "
			select distinct action.* 
			FROM action
				LEFT JOIN category_action ON action.idaction = category_action.action_idaction 
				where ".
					($categoryId> 0 ? "category_action.category_idcategory ='$categoryId' and " : "" )."
					action.active=1 
					and action.link<>'' 
					and category_action.category_idcategory is not null
				";
			
		}
		else {		
		$sql = " 
				select distinct action.* 
				FROM user_roles
				LEFT JOIN roles on user_roles.roles_idroles = roles.idroles
				LEFT JOIN roles_action ON roles.idroles = roles_action.roles_idroles
				LEFT JOIN action ON action.idaction = roles_action.action_idaction
				LEFT JOIN category_action ON action.idaction = category_action.action_idaction 
				where user_roles.user_iduser= '$userId' and ".   
					($categoryId> 0 ? "category_action.category_idcategory ='$categoryId' and " : "" )."
					action.active=1 
					and action.link<>'' 
					and roles.active=1 
					and category_action.category_idcategory is not null
				";
		}	
		$this->query($sql); 
		if ($this->result)
		{
			return $this->fetchAll();
		}
		return null;		   
	}

	/*
	  * sets user password
	  */
	public function changePassword($userId,$oldPassword,$newPassword)
	{  
		$sql = "
			update user set pass = md5('$newPassword')
			where iduser = '$userId' and pass=md5('$oldPassword') limit 1";
		$this->query($sql); 
	 
	}
	
	function getByRoleCode($code)
	{
		
	}
	
	
	/*public function getUserActions($userId,$categoryid)
	{  
		$sql = "
			select * from  action
			left join user_roles ur on action_roles = ur.roles_idroles
			left join  ar on  = ar.roles_idroles 
			where iduser = '$userId'";
		
		$this->query($sql); 
		if ($this->result)
		{
			return $this->fetchAll();
		}
		return null;		   
	}*/
    public function updateLastAccess($userId)
	{		echo date('Y-m-d H:i:s');
		     $sql="update $this->_table set $this->_lastAccess='date('Y-m-d H:i:s')' where $this->_key ='$userId'";
		     $this->query($sql);
	}
	
	
	
}