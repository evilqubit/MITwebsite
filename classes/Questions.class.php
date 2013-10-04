<?php
class Questions extends Database
{	
	public function __construct() 
	{  
		$this->_table = "questions"; 
		$this->_key = "id";
		$this->_active = "active";
		$this->_deleted="deleted"; 
		$this->getInstance();
		
	} 


	/*
	 * get a question + answer by its type and application
	 */
	public function getByType($type = 0 , $application = 0)
	{ 
		$and = $type == 0 ? ""  : " and types_idtypes = $type" ;
		$sql  = "
			select * from $this->_table 
			left join answers   on questions_id = id
			where application_id  = $application  $and
		
		" ; 
		$this->query($sql); 
		return $this->fetchAll("_setQ"); 
	}

	/*
	 * called upon setting a question
	 */
	function _setQ($row)
	{
		  $this->question[$row["qid"]] = $row; 
		return parent::_set($row);
	}
}