<?php
class AnswerGrades extends Database
{	
	public function __construct() 
	{  
		$this->_table = "jury_graded_answers";   
		$this->getInstance();
		
	} 
}