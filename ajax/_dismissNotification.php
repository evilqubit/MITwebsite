<?php
$pageId = 0;
global $supressErrors;
$supressErrors= true;
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php'; 
$auth->supressFireBug  = true;
//include ("../include/auth.php");
$id = clean($_POST["id"]);
$object= clean($_POST["object"]); 

if (isset($id))
{ 
	$obj = new Notification(); 
	$obj->activate( $id  , 0); 
	echo !$obj->error;  
}
else
echo -1;
?>
	