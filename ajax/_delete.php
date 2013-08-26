<?php
$pageId = 0;  
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php'; 
include ("../include/auth.php");
$id = clean($_POST["id"]);
$hash= clean($_POST["hash"]); 
$object= clean($_POST["object"]); 
if ($auth->validateHash($hash , array($id,$object) ))
{ 
	$obj = new $object();
	$obj->delete($id); 
}
?>
	