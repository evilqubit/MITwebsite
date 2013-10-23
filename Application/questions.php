<?php 
$support= array("DataTables" =>false,"MD5"=>false ,"Editor"=>true);
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("../include/header.php");
$type = 1;
$application = 1;
$inc =0;

$questions = new Questions;
$questions->listAll();

$answers = new Questions;
$answers->getByType($type , $application);
 
foreach ($questions->data as $question)
{ 
	$inc++;
	echo $question["qtitle_en"] . "<br>";
	
	$oFCKeditor = new FCKeditor('answer['.$answers->data[$inc]["idanswers"].']')  ;
	$oFCKeditor->BasePath	= EDITOR_PATH ;
	$oFCKeditor->ToolbarSet = 'Mini';
	$oFCKeditor->Value = $answers->data[$inc]["value"] ;
	$oFCKeditor->Create() ;
	 


}

?>



<?php
include ("../include/footer.php");
?>