<?php
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("jheader.php"); 


$id = isset($_GET["id"]) ?clean(base64_decode($_GET["id"])) : 0; // id of selected page

$application = new Application(); 


$type = 1;
$application = 1;
$inc =0;
$questions = new Questions;
$questions->listAll();

$answers = new Questions;
$answers->getByType($type , $application);


?>


<div id=content class=content>
<br><br>
<div class="errorContainer error-msg">
	<h4>Please fix the following before you can submit</h4>
</div>

 
<form method="POST" enctype="multipart/form-data" name="addedit_employee_form" id="addedit_employee_form" action="addEdit_employee.php?id=<?php echo $id; ?>&action=<?php echo ($id == 0 ? "add" : "edit");?>">
	<input type=hidden name="Employee[idemployee]"  value="null">  </input>
	<input type=hidden name="Employee[active]"  value="1">  </input>
	
	<fieldset> 
	<?php 
	 
foreach ($questions->data as $question)
{ 
	$inc++;
	//echo $question["qtitle_en"] . "<br>";
	?>
	<div class="clear10"></div>
	<div class="fm-req">
		<label for="intro"><?php echo $question["qtitle_en"] ;?></label>
		<textarea rows="" cols="" readonly><?php echo $answers->data[$inc]["value"];?></textarea> 
	</div>  
	
	
	<?php 


}
	
	
	?>
		<div class="clear10"></div>
		<div  class="fm-opt">
			<input type=submit value="Save" class=submit></input>
		</div>
	</fieldset>
</form>
</div>
<?php
include ("jfooter.php");
?> 
 