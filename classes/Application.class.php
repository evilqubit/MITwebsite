<?php
class Application extends Database
{	
	public function __construct() 
	{  
		$this->getInstance();
		$this->_table = "application"; 
		$this->_key = "id";
		// skip for normal tables
		$this->_active = "active";
		$this->_deleted="deleted"; 
		$this->_showActive = true;
		$this->_showDeleted = false;
		
	}  
 

}