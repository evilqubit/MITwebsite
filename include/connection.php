<?php 
class Database
{
	// Store the single instance of Database
	private static $m_pInstance;
	public  $result;
	public  $conn;
	public  $db;
	public  $sql;
	public  $data;
	public $count;
	public $_key;
	public $_table;
	public $_active;
	public $_showActive;
	public $_showDeleted;
	public $supressFireBug;
	public $row; 
	public $errorMsg;
	public $error;
	// Private constructor to limit object instantiation to within the class
	private function __construct() 
	{  
		$this->data = array();
		$this->supressFireBug =  SupressFireBug;
		$this->_active = "";
		//$this->_showActive = 1;
		//$this->_showDeleted = 0;
		$this->conn = mysql_connect(DB_HOST, DB_USER,DB_PASSWORD) or die("error connecting to server: ".DB_HOST ."<br>". mysql_error());
		$this->db = mysql_select_db(DB_DATEBASE) or die("error connecting to the database");  
		mysql_set_charset('utf-8');
		mysql_query("SET CHARACTER SET utf8");
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
	 
	// Test function to simulate a query
	public function query($sql)
	{
		$this->errorMsg ="";
		$this->error=0;
		$this->sql = $sql;
		$this->count=0;
		logMe($sql ,"sql");  
		if (!$this->supressFireBug)
		{ 
			echo "<script>console.log(\"sql: ".escapeJavaScriptText($sql)."\");</script>";
		}
		$this->result = mysql_query($sql)  or $this->triggerSqlError(mysql_error() ,  mysql_errno());
		return $this->result;
	}
	function triggerSqlError($error , $number)
	{
		$this->errors[] =$this->errorMsg = $error; 
		$this->error=$number;
		trigger($error , ERROR);
	}
	
	/**
	 * fetch next item
	 *
	 * @return unknown
	 */
	public function fetch( $function = "_set" )
	{  
		if ( $row = mysql_fetch_array($this->result))
		{  
			return $this->$function($row);
		}
		return null;
	}
	
	/**
	 * sets agiven data into the object parameters
	 * @param $row
	 */
	function _set($row)
	{
		return $this->row = $this->data[] = $row;   
	}
	
	
	
	/**
	 * fetch all items
	 *
	 * @return unknown
	 */
	public function fetchAll( $function = "_set")
	{   
		while ($this->fetch($function))
		{ 
			$this->count++; 
		} 
		return $this->data;
		//var_dump($this->data);
		
	}
	
	function  delete($id)
	{
		$sql= "update $this->_table set deleted=1 where $this->_key = $id limit 1";
		$this->query($sql);
	}	

	function  purge($id)
	{
		$sql= "delete from $this->_table  where $this->_key = $id ";
		$this->query($sql);
	}	
	function  purgeAll($condition =1)
	{
		$sql= "delete from $this->_table  where $condition";
		$this->query($sql);
	}
	/**
	 * 
	 * @param unknown_type $condition
	 */
	public function get($condition = 1 ) 
	{   
		$sql = "select *  from $this->_table e where $condition";
		$this->query($sql);
		return $this->fetchAll();
	}
	/*
	 * loads item of a given id
	 */
	public function load($id=0) 
	{   
		$condition ="";
		if ($id == 0) $id = $this->row[$this->_key];
			$condition = "$this->_key = '$id'  limit 1";
		return $this->get($condition);
	}	 
	/**
	 * set/deset the active field
	 * @param unknown_type $condition
	 * @param unknown_type $flag
	 */
	public function activate(  $id = 1 , $flag = 1)
	{ 
		$temp = $this->supressFireBug;
		$this->supressFireBug = true; 
		$sql = "update  $this->_table e set $this->_active = $flag
			where $this->_key=$id
		"; 
		$this->query($sql);
		$this->supressFireBug = $temp;
	}
	/*
	 * null the active field
	 */
	public function deactivate($condition = 1)
	{
		$this->activate($condition , 0);
	}	
	public function showActive()
	{
		$this->_showActive =1;
		return $this;
	}
	public function showInactive()
	{
		$this->_showActive =0;
		return $this;
	}
	public function showdeleted()
	{
		$this->_showDeleted=1;
		return $this;
	}
	public function hidedeleted()
	{
		$this->_showDeleted =0;
		return $this;
	}
	
	/*
	 * resets the data array
	 * @param int $flag
	 * @return $this
	 */
	function reset($flag=0)
	{  
		$this->count = 0;
		if ($flag) 
		{
			// normal reset
			$this->data=$this->row=null;
			return $this;
		}
		// in case we are using the data[..] fields to avoid warning
		$this->data = array();
	    $result = mysql_query('SHOW COLUMNS FROM '.$this->_table);
		while ( $row = mysql_fetch_array($result))
		{
			$this->data[0][$row["Field"]] = $this->row[$row["Field"]] = "" ;
		}
		return $this;
	}
	
	
	/*
	 * Custom insetion of data
	 */
	public function insert($values = null)
	{ 
		if (count($values) == 0) $values=$this->row;
		$sql="  INSERT INTO `$this->_table` ( "; 
		$flag=false;
		foreach ($values as  $key=>$val)
		{
			$sql.= ($flag? "," : "") ."`$key`";
			$flag=true;
		}
		$sql.= ")
		VALUES (";
		
		$flag=false;
		foreach ($values as $value)
		{
			$sql.= ($flag? "," : "") . "'$value'" ;
			$flag=true;
		}
		
		$sql.=") ";  
		 //echo $sql;//2del
		$this->query($sql);
		if ($this->error) return -1;
		//save the inserted id.
		$values[$this->_key] =  mysql_insert_id();
		$this->row = $values;
		return  $values[$this->_key];
	}
	

	/*
	 * Insert If not exist
	 * if u need to compare by id u  have to set it here if not 
	 * it will compare all the given fields
	 */
	public function insertIFNE($values = null , $id=0)
	{ 
		$sql = "
			select * from $this->_table where   
		";
		if($id> 0 ) 
		{
			$sql.= $this->_key ." = " . $id;		
		}else
		{
			$where = array();
			if (count($values) == 0) $values=$this->row;
			foreach ($values as $key=>$val)
			{
				$where[]=" $key = '$val' ";
			}
			$sql.= implode(" AND ", $where);			
		}  
		$result = $this->query($sql);
		if ( $row = mysql_fetch_array($this->result))
		{    
			return @$row[$this->_key]; 
		} 
		return $this->insert($values);
	}
	

/*
	 * Custom update of data
	 */
	function update($values =null, $condition="")
	{ 
		if (!$values) $values = $this->row;
		$sql="  UPDATE `$this->_table` SET "; 
		$flag=false;
		foreach ($values as  $key=>$val)
		{
			if ($val)
				$sql.= ($flag? "," : "") ."`$key`= '$val' ";
				else 
				$sql.= ($flag? "," : "") ."`$key`= null ";
				
			$flag=true;
		}
		if ($condition != "" )
			$sql .= " Where ".$condition;		
		else if (isset($values[$this->_key]))
			$sql.= "WHERE  $this->_key = '" . $values[$this->_key] ."'  LIMIT 1";
			else
			$sql.= "WHERE  $this->_key = '" . $this->row[$this->_key] ."'  LIMIT 1";
			
		$this->query($sql);
	}

	public function listAll($condition= 1 , $join="", $select="")
	{ 
		$and = (isset($this->_showActive )&& $this->_showActive) ? " and active=1" : "";
		$and .= (isset($this->_showDeleted) && !$this->_showDeleted)? " and deleted=0" : "";
		
		$sql = "select e.* $select  from $this->_table e 
		$join
		where $condition $and ";
		 $this->query($sql); 
		if ($this->result)
		{
			return $this->fetchAll();			
		}
		return null;		   
	}
	

	/**
	 * return the full name from an array
	 * @param unknown_type $array
	 */
	public function get_name($array =null   , $parameters=null)
	{
		
		if (!isset($array)) $array = $this->row;
		$output =  	$array["title"]!=""? $array["title"] . " " : "";
		$output .=  	$array["fname"]!=""? $array["fname"] . " " : "";
		$output .=  	$array["mname"]!=""? (mb_substr($array["mname"], 0, 1, 'utf8'). ". " ): "";
		$output .=  	$array["lname"]!=""? $array["lname"] . " " : ""; 
		return $output;
	}
	
}
$conn = Database::getInstance(); // establishing connection to database

/********
 * JA : Anti hack code
*/
// anti sql injection
foreach($_REQUEST AS $key => $value) {
	if ( !is_array($value) )
		$_REQUEST[$key] = mysql_real_escape_string($value);
}

 
?>