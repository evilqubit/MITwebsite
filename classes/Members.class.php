<?php
class Members extends Database
{	
	public function __construct() 
	{  
		$this->getInstance();
		$this->_table = "members"; 
		$this->_key = "id";
		// skip for normal tables
		$this->_active = "active";
		$this->_deleted="deleted"; 
		$this->_showActive = true;
		$this->_showDeleted = false;
		
	}  

	public function getByApplicationId($applicationId)
	{
		$condition = "applicationId = $applicationId";
		return $this->listAll($condition);
	}

}