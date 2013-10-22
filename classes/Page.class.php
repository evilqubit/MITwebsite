<?php
class Page extends Database
{	
	public function __construct() 
	{  
		$this->_table = "pages"; 
		$this->_key = "id"; 
		$this->getInstance();
		
	} 
	
	public function getByAlias($alias='') 
	{    
		$condition = "alias = '$alias'  limit 1";
		return $this->get($condition);
	}

 
}