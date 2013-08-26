<?php 
include_once ("../include/config.php");
include_once ("../include/functions.php");
include_once ("../include/header.php");
require_once "../classes/Trigger.class.php";
require_once "../include/ar.inc";
$tr=new trigger();

$tr->settrigger(_text(404),WARNING);

$tr->display();
?>
 
 
<?php
include ("../include/footer.php");
?> 

