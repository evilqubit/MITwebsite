<?php
/*
 * class to preload the user allowed actions
 */
class Actions
{ 
	// Private constructor to limit object instantiation to within the class
	private function __construct() 
	{  
	}

	// Getter method for creating/returning the single instance of this class
	public static function getInstance()
	{
		if (!self::$m_pInstance)
		{
			self::$m_pInstance = new Database();
		}

		return self::$m_pInstance;
	}
	  
	
	
} 	
// ussage 
	$actions = Actions::getInstance(); 
 
 
?>