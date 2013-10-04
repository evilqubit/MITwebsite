<?php 

/************************************************
 *                                         
 *  MIT Arab Competition
 * ********************************************* 
 *             
 *  File name:   /competition/classes/Trigger.class.php
 *  Sep 7, 2013
 *  
 *************************************************/
 
require_once "../include/config.php";

class  trigger {
	
	//--- Class Attributes
	public $msgstr;
	public $active;
	
	//--- Class Constants
	
	// --------------------------------------------------------------------
	//--- Constructor
	function  trigger()
	{
	// Create global array (Message table)
	$this->msgstr =  array();
	
	} 
	// --------------------------------------------------------------------
	//--- Clear Method
	function clear()
	{
	unset($this->msgstr);
	
	}
	// --------------------------------------------------------------------
	//-- Add Method
	function settrigger($m,$type)
	{// Append to array
		$this->msgstr[$type][] = $m;
		$this->active =1;
	} 
	// --------------------------------------------------------------------
	
	function display(){
		global $classArr;
		foreach ($this->msgstr as $key=> $val){
			{
				
				/*
				foreach ($val  as $e)
				{
					if(!in_array($key,$val))
					{echo "<span class=\"".$classArr[$key]."\">  $e  </span>";}
				
				}
				*/
				if($val)
				{
					?>
					
					<div class="<?php  echo  $classArr[$key]; ?>">  
					<?php
					    echo("<ul style=\"list-style-type:none\">");
						foreach ($val  as $e)
						{
							echo "<li>".$e . " </li>";
						} 
						echo ("</ul>");
						?>
						
					</div>
						
					<?php 
				}
				
				echo"<div class=\"clear10\"></div>";
			}
		}
		
	}
	function isActive()
	{	
		return $this->active;
	}
	
}// class 
?>