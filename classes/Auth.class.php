<?php 
include_once '../include/connection.php';
include_once '../include/functions.php';
class Auth extends Database
{	
	private $action;
	private $userId;
	public $roles;
	
	// set of allowed actions
	public $allowed; 
	private $_hash;
	
	public function __construct() 
	{   
		@$this->userId = $_SESSION['user_authorized'];
		
		// load database
		$this->getInstance();
		$this->_hash = HASH_KEY;
	}
	
	public function loadUser()
	{  
		$user = new Users();
		$user->supressFireBug =true;
		return $user->getById($this->userId);  
	}
	/*
	 * Function to load all the allowed actions of a logged in user
	 */
	public function loadRoleActions($forceReload = 0)
	{
		if ($forceReload || !$this->allowed)
		{ 
			$sql = "
			SELECT *
				FROM user_roles
				LEFT JOIN roles on user_roles.roles_idroles = roles.idroles
				LEFT JOIN roles_action ON roles.idroles = roles_action.roles_idroles
				LEFT JOIN action ON action.idaction = roles_action.action_idaction
				where user_roles.user_iduser= '$this->userId' and action.active=1 and roles.active=1
			";
			$this->query($sql);
			while($this->fetch())
			{
				$this->allowed[$this->row["code"]] = 1;
			}
		} 
		return $this->allowed;
	}
	
	/*
	 * checks if this is a super administrator.
	 */
	function isSuper()
	{
		// user should be logged in a authenticated with admin privileges
		return  (isset($_SESSION['auth'] ) && $_SESSION['auth'] && $_SESSION['isSuper']) ;
	}

	function isEmployee()
	{
		// checks if the user has an assigned employee id.
		return  (isset($_SESSION['employee'] ) && $_SESSION['employee']) ;
	}
	/**

	gets the allowed tabs of a certain user
	 */
	public function getUserTabs($parent=0)
	{
		$user = new Users(); 	
		$user->getUserTabs($this->userId , $this->isSuper(),$parent);   
		return $user->fetchAll(); 
	}
	 /*
	  * get the actions of the m logged in user on a specified category
	  */
	public function getUserActions($categoryId)
	{   
		$user = new Users();
		$user->getUserActions($this->userId,$categoryId, $this->isSuper());   
		return $user->fetchAll(); 
	}
	 /*
	  * sets user password
	  */
	public function changePassword($oldPassord,$newPassword)
		{  
			 $user = new Users();
		     $user->changePassword($this->userId,$oldPassord,$newPassword);   
		}
		
	/*
	 * checks if the logged in user have enought privileges to access a section
	 */
	public function canDo($actionCode)
	{
		if (isset($this->allowed[$actionCode]) && $this->allowed[$actionCode] == 1) return true;
		return $this->isSuper();
	}
	
	/**
	 * logged in user must be an employee
	 */
	public function forceEmployee()
	{
		if(!$this->isEmployee()) $this->deny("Force Employee");
	}
	/**
	 *   only specific role users are allowed
	 * @param $code
	 */
	public function forceRole($code, $msg="Not enough privileges")
	{
		if(!$this->hasRole($code)) $this->deny($msg); 
	}
	/*
	 * Deny user from getting into a page.
	 */
	public function deny($msg = "Access Denied")
	{ 
		setTrigger(_text($msg) , WARNING);  
		header("location: ../Admin/deny.php");
		exit();
		
	}

	public function home($msg = null , $type=INFO)
	{  
		isset($msg)?setTrigger(_text($msg) , $type): "";  
		header("location: ../Admin/profile.php");
		exit();
		
	}
	
	/**
	 * check if a given hash is valid for the parameters 
	 * @param $hash
	 * @param $parameters
	 */
	public function validateHash($hash , $parameters)
	{
		$param = is_array($parameters)?  implode("",$parameters) : $parameters; 
		// echo $param . ": ".  md5( $this->_hash.$param) . "---". $hash;
		return md5( $this->_hash.$param)== $hash;
	}
	/**
	 * create a hash from  a string
	 * @param unknown_type $parameters
	 */
	public function hash( $parameters)
	{
		$param = is_array($parameters)?  implode("",$parameters) : $parameters;
		return md5( $this->_hash.$parameters);
	}
	public function  sendHash($hashmsg)
	{
		$sql = "update user set hash='$hashmsg' where userid='$this->userId'";
		$this->query($sql);
	}
		public function  receiveHash()
	{
		$sql = "update user set hash='' where userid='$this->userId'";
		$this->query($sql);
	}
	public function validHash($hashcode)
	{
		$sql = "select  user set hash='' where userid='$this->userId'";
	}
     public function updateLastAccess($id)
	{		
		     $user = new Users();
		    //$user->row[$user->_key] = $id;
		     $data = array('lastAccess'=>date("Y-m-d H:i:s") , $user->_key => $id);
		     $user->update($data);
	}
	
	/**
	 * checks if the logged in used has a  given role
	 * @param $code
	 */
   public  function hasRole($code)
	{		 	      
		$sql = "
		    select * from  user_roles,roles
			where   
			 roles.idroles  = user_roles.roles_idroles 
			and user_iduser = '$this->userId' 
			and roles.code='$code'";
		
		 $result = $this->query($sql); 
		if ($result)
		{
			$res= $this->fetchAll();
			if($this->count>0)return true;
		}
		return false;		   
	
	}
 
}