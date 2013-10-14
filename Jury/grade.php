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
	 
	$mysheet = new DataSheet();
	$mysheet->tableStyleClass="";
	$mysheet->openSheetTable("application",  "90%", 0,0 );
	$mysheet->headerRowStyleClass = 'TableHeadersColorNass';
	$fields	= array(_text("#"),_text("Question"),_text("Answer"),_text("Grade"));
	$width = array('10px;','300px','' , '12px'); 
	$mysheet->addSheetTableHeader( $fields , $width,"center" ,1); 
	
	
	echo " <pre>";
	print_r($questions);
	echo "</pre>";
foreach ($questions->data as $question)
{ 
	$inc++;
	//echo $question["qtitle_en"] . "<br>";
	
		$mysheet->openSheetTableRow($question["id"]);
		$mysheet->addSheetCell(  $inc); 
		$mysheet->addSheetCell(  $question["qtitle_en"]); 
		$mysheet->addSheetCell($answers->data[$inc]["value"]); 
		if ($question["grade"] > 0)
		{
			$data = "<select>";
			for ($i = 0 ; $i <=$question["grade"]; $i++ )
				$data.= " <option value='$i'>$i</option>";
			$data .= "</select>";
			$mysheet->addSheetCell($data);   
		}else 
		$mysheet->addSheetCell(  "-");   
		$mysheet->closeSheetTableRow(); 
		
		/*
	?>
	<div class="clear10"></div>
	<div class="fm-req">
		<label for="intro"><?php echo $question["qtitle_en"] ;?></label>
		<textarea rows="" cols="" readonly><?php echo $answers->data[$inc]["value"];?></textarea> 
	</div>  
	
	
	<?php */


}
	$mysheet->closeSheetTable();
	
	
	?> 
		<div class="clear10"></div>
		<div style="width:90%; padding: 1px; text-align:center">
			<input type=submit name=save value="Save" class=submit></input>
			<input type=submit name=submit value="Save & Submit" class=submit></input>
			<input type=submit name=disqualify value="Disqualify" class=submit></input>
		</div>
	</fieldset>
</form>
</div>
<?php
include ("jfooter.php");
?> 
 <script type="text/javascript" charset="utf-8">
	$(document).ready(function() { 
		$('#application').dataTable( {  
			 "sDom": 'tr' , 
			"iDisplayLength": -1  
		} ); 
		
	} ); 
</script>