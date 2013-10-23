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
	
	/**
	 * gets all apps assigned to a certain jury
	 *
	 * @param unknown_type $idjury
	 */
	public function getByJury($idjury)
	{
		$sql = "select * from application
			left join jury_has_application ja on application_id = application.id
			where jury_idjury = '$idjury'
		
		";
		$this->query($sql); 
		return $this->fetchAll(); 
	}
	
	/**
	 * get the questions and answers of a specific application
	 *
	 * @param unknown_type $idapplication
	 * @return unknown
	 */
	public function getQuestionAnswers($idapplication = 0 )
	{
		$id =  $idapplication > 0 ? $idapplication : $this->row[$this->_key ];
		
		$sql =  "
			select * from questions q
			left join answers a on  ( a.questions_id = q.id and a.application_id = $id ) 
		
		" ; 
		$this->query($sql); 
		return $this->fetchAll();
	}
 

}