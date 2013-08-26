<?php 
include ("../include/config.php");
include ("../include/functions.php");
include ("../include/header.php");
require_once "../classes/Trigger.class.php";
require_once "../include/ar.inc";
$tr=new trigger(); 
$tr->settrigger(_text(403),WARNING); 
$tr->display();
?>
 
 
<?php
include ("../include/footer.php");
?> 

