<?php
include_once ("../include/config.php");  
include_once ("../include/connection.php"); 
include_once ("../include/functions.php");
   
   //(!isset($_SESSION['tries'][$_POST["login"]]))? $_SESSION['tries']["$_POST[login]"]=0:$_SESSION['tries']["$_POST[login]"]++;
   
   @$_SESSION['tries'][$_POST["login"]]++;
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation e rror flag
	$errflag = false;
	
	//Input Validations
	if($_POST['login'] == '') {
		setTrigger(_text("Login ID missing") , ERROR); 
		$errflag = true;
	}
	
	if($_POST['password'] == '') {
		setTrigger(_text("Password missing") , ERROR); 
		$errflag = true;
	}
	//Sanitize the POST values
	$login = clean($_POST['login']); 
	$_SESSION['login']=$login;
	$password = md5(clean($_POST['password']));
	
	//If there are input validations, redirect back to the login form
	if($errflag) { 
		header("location: ../Main/index.php");
		exit();
	}
	
     	
    
	//Create query 
	$qry="SELECT * FROM jury WHERE login='$login' AND 	pass ='".$password."' and active=1 and deleted=0";
	$result=mysql_query($qry);
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			
			//session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			//error_reporting(0);
			//session_start();
			//session_register('user_authorized');
			$_SESSION['auth']="true"; 
			$_SESSION['user_authorized'] = $member['id']; 
			$_SESSION['name'] = $member['name']; 
			$_SESSION['login'] = $member['login'] ;
		    if(isset($_POST["captcha"])){
				if($_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
				{
				  //die("Correct Code Entered");
				  $_SESSION['showCaptcha']=false; 
				  header("location: ../Jury/index.php");
				
				//Do you stuff
				}
				else
				{
				 
					setTrigger(_text("Wrong Captcha Code", "General"), ERROR);
				  header("location: ../Jury/login.php");
				 
				}
			   exit();
		    }
			//setTrigger(_text("Successful Login") , SUCCESS);  
			header("location: ../Admin/profile.php");
			exit();
		} 
	}
    setTrigger(_text("Invalid Login") , ERROR); 
    
     if ( @$_SESSION['tries'][$_POST["login"]]>= 3 )
     {
		$_SESSION['showCaptcha'] = true; 
    	header("location: ../Admin/login.php");
     } 
	else header("location: ../Main/index.php");
	exit();
?>