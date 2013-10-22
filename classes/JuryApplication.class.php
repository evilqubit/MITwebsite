<?php
/**
 * for the jury has application table
 *
 */
class JuryApplication extends Database
{	
	public function __construct() 
	{  
		$this->getInstance();
		$this->_table = "jury_has_application"; 
		$this->_key = array("jury_idjury", "application_id" );
	 
		
	} 
	
	 
}