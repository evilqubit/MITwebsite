<?php
$pageId = 0;
global $supressErrors;
$supressErrors= $supressFireBug = true;

include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php'; 
include ("../include/auth.php");
$id = clean($_POST["id"]);
$hash= clean($_POST["hash"]); 
$object= clean($_POST["object"]); 
$flag=$_POST["flag"];
if ($auth->validateHash($hash , array($id,$object) ))
{ 
	$obj = new $object();
	$obj->activate($id , $flag);  
	echo $obj->error > 0 ? $obj->error : $flag;
}
else
{ 
	echo INVALIDHASH;
}
?>
	