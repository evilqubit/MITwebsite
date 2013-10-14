<?php

/************************************************
 *                                         
 *  MIT Arab Competition
 * ********************************************* 
 *             
 *  File name:   /competition/include/functions.php
 *  Aug 26, 2013
 *  
 *************************************************/

/*
function isAdmin()
{
	return  (isset($_SESSION['auth'] ) && $_SESSION['auth'] =="true") ;
}*/

function getTimerOptions( $val =0 )
{
	return '    
        <option value="08:00:00" '.($val=="08:00:00"? "selected":"").'>08:00</option>      
        <option value="08:30:00" '.($val=="08:30:00"? "selected":"").'>08:30</option>      
        <option value="09:00:00" '.($val=="09:00:00"? "selected":"").'>09:00</option>      
        <option value="09:30:00" '.($val=="09:30:00"? "selected":"").'>09:30</option>      
        <option value="10:00:00" '.($val=="10:00:00"? "selected":"").'>10:00</option>      
        <option value="10:30:00" '.($val=="10:30:00"? "selected":"").'>10:30</option>      
        <option value="11:00:00" '.($val=="11:00:00"? "selected":"").'>11:00</option>      
        <option value="11:30:00" '.($val=="11:30:00"? "selected":"").'>11:30</option>      
        <option value="12:00:00" '.($val=="12:00:00"? "selected":"").'>12:00</option>     
        <option value="12:30:00" '.($val=="12:30:00"? "selected":"").'>12:30</option> 
        <option value="01:00:00" '.($val=="01:00:00"? "selected":"").'>01:00</option>     
        <option value="01:30:00" '.($val=="01:30:00"? "selected":"").'>01:30</option>      
        <option value="02:00:00" '.($val=="02:00:00"? "selected":"").'>02:00</option>      
        <option value="02:30:00" '.($val=="02:30:00"? "selected":"").'>02:30</option>      
        <option value="03:00:00" '.($val=="03:00:00"? "selected":"").'>03:00</option>   
        ';
}


/*
 * Anti injection
Function to sanitize values received from the form. Prevents SQL injection
 */
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
} 
/**
 * 
 * Reads the message table and retrieves a certain custom message for the user
 * according to language
 * if the language not found it returns it in english
 * @param unknown_type $str
 * @param unknown_type $lang
 */
function get_message($str , $lang)
{
	$sql = "select * from messages where message_name='".$str."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result, MYSQL_ASSOC); 
	return $row["message_".$lang] == "" ? $row["message_en"]: $row["message_".$lang];	
}



/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      /*
      if ($isValid && !(checkdnsrr($domain,"MX") || 
 ↪checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
      */
   }
   return $isValid;
}

/*
 * To filter inoput against xss attacks
 */
function FilterHTML($string) {
    if (get_magic_quotes_gpc()) {
        $string = stripslashes($string);
    }
    $string = html_entity_decode($string, ENT_QUOTES, "ISO-8859-1");
    // convert decimal
    $string = preg_replace('/&#(\d+)/me', "chr(\\1)", $string); // decimal notation
    // convert hex
    $string = preg_replace('/&#x([a-f0-9]+)/mei', "chr(0x\\1)", $string); // hex notation
    //$string = html_entity_decode($string, ENT_COMPAT, "UTF-8");
    $string = preg_replace('#(&\#*\w+)[\x00-\x20]+;#U', "$1;", $string);
    $string = preg_replace('#(<[^>]+[\s\r\n\"\'])(on|xmlns)[^>]*>#iU', "$1>", $string);
    //$string = preg_replace('#(&\#x*)([0-9A-F]+);*#iu', "$1$2;", $string); //bad line
    $string = preg_replace('#/*\*()[^>]*\*/#i', "", $string); // REMOVE /**/
    $string = preg_replace('#([a-z]*)[\x00-\x20]*([\`\'\"]*)[\\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iU', '...', $string); //JAVASCRIPT
    $string = preg_replace('#([a-z]*)([\'\"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iU', '...', $string); //VBSCRIPT
    $string = preg_replace('#([a-z]*)[\x00-\x20]*([\\\]*)[\\x00-\x20]*@([\\\]*)[\x00-\x20]*i([\\\]*)[\x00-\x20]*m([\\\]*)[\x00-\x20]*p([\\\]*)[\x00-\x20]*o([\\\]*)[\x00-\x20]*r([\\\]*)[\x00-\x20]*t#iU', '...', $string); //@IMPORT
    $string = preg_replace('#([a-z]*)[\x00-\x20]*e[\x00-\x20]*x[\x00-\x20]*p[\x00-\x20]*r[\x00-\x20]*e[\x00-\x20]*s[\x00-\x20]*s[\x00-\x20]*i[\x00-\x20]*o[\x00-\x20]*n#iU', '...', $string); //EXPRESSION
    $string = preg_replace('#</*\w+:\w[^>]*>#i', "", $string);
    $string = preg_replace('#</?t(able|r|d)(\s[^>]*)?>#i', '', $string); // strip out tables
    $string = preg_replace('/(potspace|pot space|rateuser|marquee)/i', '...', $string); // filter some words
    //$string = str_replace('left:0px; top: 0px;','',$string);
    do {
        $oldstring = $string;
        //bgsound|
        $string = preg_replace('#</*(applet|meta|xml|blink|link|script|iframe|frame|frameset|ilayer|layer|title|base|body|xml|AllowScriptAccess|big)[^>]*>#i', "...", $string);
    } while ($oldstring != $string);
    return addslashes($string);
}

/*
 * To show the filtered submitted code
 */
function format_db_value($text, $nl2br = false) {
    if (is_array($text)) {
        $tmp_array = array();
        foreach ($text as $key => $value) {
                $tmp_array[$key] = format_db_value($value);
        }
        return $tmp_array;
    } else {
        $text = htmlspecialchars(stripslashes($text));
        if ($nl2br) {
                return nl2br($text);
        } else {
                return $text;
        }
    }
}

/**
 * Translates a  string
 * @param $input
 * @param $page
 */
function _text($input , $page = "General")
{
	global $_lang;
	if (isset($_lang[$page][$input]) && $_lang[$page][$input] !="")
	{
		return $_lang[$page][$input];
	}
	return $input;
}
/**
 * 
 * @param unknown_type $msg
 * @param unknown_type $type
 */
function trigger($msg , $type  = ERROR )
{
	$_SESSION['ERRMSG_ARR'][] = $msg;
}



/*
 * log a stiring into a file
 */
function logMe($txt , $fileName ="")
{
	
	if ($fileName == "" )
	{
		//$fileName = "logs/". date("Ymd");
		$fileName = "../logs/log". date("Ymd").".log";
	} 
	else
	{
		$fileName ="../logs/".$fileName.date("Ymd").".log";
	}
	
	$f = fopen($fileName,'a+');
	$txt.="\n\t From Ip: " .$_SERVER["REMOTE_ADDR"]." - Date: ".date('Y-m-d H:i:s')."\n\t";

	fwrite($f,$txt,strlen($txt));
	fclose($f);  
}

/**
 * has a string 
 * @param $input
 */ 
function hashMe($input)
{
	return md5(HASH_KEY . $input); 
}
/**
 * filter php input to put in js
 * @param unknown_type $string
 */
function escapeJavaScriptText($string) 
{ 
    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\"))); 
} 


function setTrigger ($msg , $type = SUCCESS)
{ 
	$trigger=  isset($_SESSION["trigger"]) ? unserialize($_SESSION["trigger"]) : new trigger(); 
	//var_dump($trigger);die();
	$trigger->settrigger($msg,$type);
	$_SESSION["trigger"] = serialize ($trigger);
	
}
function displayTrigger()
{ 
	if(isset($_SESSION["trigger"]))
	{
		//var_dump(unserialize($_SESSION["trigger"]));
		$trigger = unserialize($_SESSION["trigger"]);
		$trigger->display();
	}
	unset($_SESSION["trigger"]); 
}

/*
 * just to display english french etc...
 */
function print_language($lang)
{
	switch ($lang)
	{
		case 1: return "ar";break;
		case 2: return "en";break;
		case 3: return "fr";break;
		case "ar": return "عربي";break;
		case "en": return "English";break;
		case "fr": return "French";break;
		default: return "";
	}
}

/*
 * just to display the grade 
 * 
 */
function print_grade($grade)
{
	switch ($grade)
	{
		case "1": return "أ";break;
		case "2": return "ب";break;
		case "3": return "ج";break; 
		default: return "الشعبة $grade";break;
	}
}


function displayType($type)
{
	if($type==1) return  _text("newbie" , "Evaluate");
	else if($type==2) return   _text("oldies" , "Evaluate"); 
	else return  _text("re-evaluate" , "Evaluate"); 
}

function displayEvaluationStatus($status)
{
	switch ($status) {
		case EVALUATIONNOTSTARTED: return _text("EVALUATIONNOTSTARTED")
		;
		break;
		case EVALUATIONPENDING: return _text("EVALUATIONPENDING")
		;
		break;
		case EVALUATIONINPROGRESS: return _text("EVALUATIONPAHSE1")
		;
		break;
		case EVALUATIONFINALIZED: return _text("EVALUATIONFINALIZED")
		;
		break;
		
		default:
			;
		break;
	}
}

/**
 * this function used to display the name of an occupation Type id
 * @param $type
 * veteran is not a type but some academic-managment are treated veteran like in the 
 * evaluation proccess,
 * veteran only applies to the 
 */
function displayOccupationType($type)
{
	switch ($type) { 
		case ACADEMIC: return _text("Academic")
		;
		break;
		case NONACADEMIC: return _text("Non-Academic")
		;
		break;
		case ACADEMICAdmin: return _text("Academic-Administration")
		;
		break;
		case VETERAN: return _text("Academic-Administration")
		;
		break;
		
		default:
			;
		break;
	}
	return '';
}


























 
/**
 * Ahmad login related functions
 */

function createAccount($data) {
	//Array ( [type] => 1 [username] => admin1 [password] => 123456 [fname] => sas [lname] => dsvdv 
	//		[email] => dev.ahmadrahhal@gmail.com [country] => Lebanon [competition] => 4 [lang] => fr )
	// First check we have data passed in.
	
	$pUsername = $data['username'];
	$pPassword = $data['password'];
	$email =  $data['email'];
    $type =  mysql_real_escape_string($data['type']);
	$fname =  mysql_real_escape_string($data['fname']);
	$lname =  mysql_real_escape_string($data['lname']);
	$country =  mysql_real_escape_string($data['country']);
	$lang =  mysql_real_escape_string($data['lang']);
	$competition =  mysql_real_escape_string($data['competition']);
	
	
	if (!empty($pUsername) && !empty($pPassword)) {
		$uLen = strlen($pUsername);
		$pLen = strlen($pPassword);
		
		// escape the $pUsername to avoid SQL Injections
		$eUsername = mysql_real_escape_string($pUsername);
	    $sql = "SELECT username FROM users WHERE username = '" . $eUsername . "' LIMIT 1";

		$eEmail = mysql_real_escape_string($email);
		$sql2 = "SELECT username FROM users WHERE email = '" . $eEmail . "' LIMIT 1";
		
		
		// Note the use of trigger_error instead of or die.
		$query = mysql_query($sql) or die ("Query Failed: " . mysql_error());
		$query2 = mysql_query($sql2) or die("Query Failed: " . mysql_error());
		// Error checks (Should be explained with the error)
		if ($uLen <= 4 || $uLen >= 11) {
			$_SESSION['error'] = "Username must be between 4 and 11 characters.";
		}elseif ($pLen < 6) {
			$_SESSION['error'] = "Password must be longer then 6 characters.";
		}elseif (mysql_num_rows($query) == 1) {
			$_SESSION['error'] = "Username already exists.";
		}elseif (mysql_num_rows($query2) == 1) {
			$_SESSION['error'] = "Email already exists.";
		}
		else {
			
			
			
			// All errors passed lets
			
			$sqlApp = "INSERT INTO application (`types_idtypes`, `lang`) VALUES ('" . $type . "', '" . $lang . "');";
			$queryApp = mysql_query($sqlApp) or trigger_error("Query Failed: " . mysql_error());
			$row = mysql_insert_id();
			if ($queryApp) {
			
			$sql = "INSERT INTO users (`username`, `password` , `email`,`lang`,`fname`,`lname`,`country`,`applicationId`,`learn`) VALUES ('" . $eUsername . "', '" . hashPassword($pPassword, SALT1, SALT2) . "','".$email."','".$lang."','".$fname."','".$lname."','".$country."','".$row."','".$competition."');";
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
			if ($query) {
				return true;
			}
			}	
		}
	}
	
	return false;
}

/***********
	string hashPassword (string $pPassword, string $pSalt1, string $pSalt2)
		This will create a SHA1 hash of the password
		using 2 salts that the user specifies.
************/
function hashPassword($pPassword, $pSalt1="2345#$%@3e", $pSalt2="taesa%#@2%^#") {
	return sha1(md5($pSalt2 . $pPassword . $pSalt1));
}

/***********
	bool loggedIn
		verifies that session data is in tack
		and the user is valid for this session.
************/
function loggedIn() {
	// check both loggedin and username to verify user.
	if (isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {
		return true;
	}
	
	return false;
}

/***********
	bool logoutUser 
		Log out a user by unsetting the session variable.
************/
function logoutUser() {
	// using unset will remove the variable
	// and thus logging off the user.
	unset($_SESSION['username']);
	unset($_SESSION['loggedin']);
	
	return true;
}

/***********
	bool validateUser
		Attempt to verify that a username / password
		combination are valid. If they are it will set
		cookies and session data then return true. 
		If they are not valid it simply returns false. 
************/
function validateUser($pUsername, $pPassword) {
	// See if the username and password are valid.
	$sql = "SELECT username,applicationId FROM users 
		WHERE username = '" . mysql_real_escape_string($pUsername) . "' AND password = '" . hashPassword($pPassword, SALT1, SALT2) . "' LIMIT 1";
	$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
	
	// If one row was returned, the user was logged in!
	if (mysql_num_rows($query) == 1) {
		$row = mysql_fetch_assoc($query);
		$_SESSION['username'] = $row['username'];
		$_SESSION['applicationId'] = $row['applicationId'];
		$_SESSION['loggedin'] = true;
			
		return true;
	}
	return false;
}

function checkEmail($email) {
		// See if the username and password are valid.
		$sql = "SELECT username,email,uid FROM users
		WHERE email = '" . mysql_real_escape_string($email) .  "' LIMIT 1";
		$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
	
		// If one row was returned, the user was logged in!
		if (mysql_num_rows($query) == 1) {	
			$row = mysql_fetch_assoc($query);
			$data['id'] = $row['uid'];
			$data['username']  = $row['username'];
			return $data;
		}	
	return false;
}

function updatePassword($password,$userId){
  $sql = "update users set password='".hashPassword($password, SALT1, SALT2) ."' where uid = ".$userId;
	$query = mysql_query($sql);
	if ($query) {
		return true;
	}
	return false;
}

function getMember($mid){
	
	$sql = "SELECT * FROM members
	WHERE id = '" . mysql_real_escape_string($mid) .  "' LIMIT 1";
	
	$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
	
	if (mysql_num_rows($query) == 1) {
		$row = mysql_fetch_assoc($query);
		$data['id'] = $row['id'];
		$data['fname']  = $row['fname'];
		$data['lname']  = $row['lname'];
		$data['gender']  = $row['gender'];
		$data['birth']  = $row['birth'];
		$data['nationality']  = $row['nationality'];
		$data['education']  = $row['education'];
		$data['other_education']  = $row['other_education'];
		$data['major']  = $row['major'];
		$data['graduation_year']  = $row['graduation_year'];
		$data['profectional_background']  = $row['profectional_background'];
		$data['current_occupation']  = $row['current_occupation'];
		$data['email']  = $row['email'];
		$data['graduation_year']  = $row['graduation_year'];
		$data['phone']  = $row['phone'];
		return $data;
	}
	return false;
	
}

function editMember($editMember){
	
	$fname =mysql_real_escape_string($editMember['lname']) ;
	$lname =mysql_real_escape_string($editMember['fname']) ;
	$birth = mysql_real_escape_string($editMember['birth']) ;
	$nationality = mysql_real_escape_string($editMember['nationality']) ;
	$major = mysql_real_escape_string($editMember['major']) ;
	$graduation =mysql_real_escape_string($editMember['graduation']) ;
	$phone =mysql_real_escape_string($editMember['phone']) ;
	$email =mysql_real_escape_string($editMember['email']) ;
	$background =mysql_real_escape_string($editMember['background']) ;
	$occupation =mysql_real_escape_string($editMember['occupation']) ;
	$education =mysql_real_escape_string($editMember['education']) ;
	$gender =mysql_real_escape_string($editMember['gender']) ;
	$uid =mysql_real_escape_string($editMember['uid']) ;
	$other =mysql_real_escape_string($editMember['other']) ;
	$sql = "update members set phone='".$phone."', email='".$email."',current_occupation='".$occupation."', profectional_background ='".$background."',graduation_year='".$graduation."', major ='".$major."',other_education='".$other."', education ='".$education."', nationality ='".$nationality."', birth ='".$birth."',fname='".$fname."', lname='".$lname."',gender ='".$gender."'  where id = ".$uid;
	
	$query = mysql_query($sql);
	if ($query) {
		return true;
	}
	return false;
	
}

function addMember($addMember){
	
	
	$fname =mysql_real_escape_string($addMember['lname']) ;
	$lname =mysql_real_escape_string($addMember['fname']) ;
	$birth = mysql_real_escape_string($addMember['birth']) ;
	$nationality = mysql_real_escape_string($addMember['nationality']) ;
	$major = mysql_real_escape_string($addMember['major']) ;
	$graduation =mysql_real_escape_string($addMember['graduation']) ;
	$phone =mysql_real_escape_string($addMember['phone']) ;
	$email =mysql_real_escape_string($addMember['email']) ;
	$background =mysql_real_escape_string($addMember['background']);
	$occupation =mysql_real_escape_string($addMember['occupation']);
	$education =mysql_real_escape_string($addMember['education']);
	$gender =mysql_real_escape_string($addMember['gender']);
	$other =mysql_real_escape_string($addMember['other']) ;
	$appId =mysql_real_escape_string($addMember['appId']) ;
	
	
	$sql = "INSERT INTO members (`phone`, `email` , `current_occupation`,`profectional_background`,`graduation_year`
	,`major`,`other_education`,`education`,`nationality`,`birth`,`fname`,`lname`,`gender`,`applicationId`)
	 VALUES ('" . $phone . "', '" .$email. "','".$occupation."',
	'".$background."','".$graduation."','".$major."','".$other."','".$education."','".$nationality."'
	,'".$birth."','".$fname."','".$lname."','".$gender."','".$appId."');";
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
	if ($query) {
		return true;
	}
	return false;

}

function deleteMember($memberId){
	$sql = "delete FROM  members where id = ".mysql_real_escape_string($memberId) ;
	$query = mysql_query($sql);
	if ($query) {
		return true;
	}
	return false;	
}

function getAppMembers($appId){

	$sql = "SELECT id,fname,lname FROM members
	WHERE applicationId = '" . mysql_real_escape_string($appId)."'" ;

	$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
	$key = 0;
	while($row = mysql_fetch_assoc($query))
	{
		$data[$key]['id'] = $row['id']; 
		$data[$key]['fname'] = $row['fname'];
		$data[$key]['lname'] = $row['lname'];
		$key++;
	}

	
		return $data;

}
?>