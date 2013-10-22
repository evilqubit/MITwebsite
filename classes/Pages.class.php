<?php
class Pages extends Database
{	
	public function __construct() 
	{  
		$this->_table = "pages"; 
		$this->_key = "id"; 
		$this->getInstance();
		
	} 

 
}