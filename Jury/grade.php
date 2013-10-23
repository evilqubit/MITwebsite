<?php
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';

	
include ("jheader.php"); 

$id = isset($_GET["id"]) ?clean(base64_decode($_GET["id"])) : 0; // id of selected page
$idjury = $_SESSION['user_authorized'];

$appquestions = new Application();
$appquestions->getQuestionAnswers($id);
 
if (isset($_POST["save"]))
{
	// if the submit button is pressed
	$inc = 0;
	$grade = new  AnswerGrades();
	foreach ($_POST["grading"] as $key=>$arr	)
	{
		$inc ++ ; 
		$condition = " where answers_idanswers =$key and jury_id = $idjury";
		var_dump($arr);
		$grade->update($arr , $condition);
		var_dump($grade);
		/*
		if (!$ja->error)
		{
			setTrigger(_text("Grade for question #$inc saved successfully", "General"), SUCCESS);
		}
		else
		{
			setTrigger(_text("Sorry could not update the grade for question #$inc", "General"), ERROR); 
		}*/
	}
	// update the jury application 
	
		$ja = new JuryApplication(); 
		$condition  = " jury_idjury = $idjury and  application_id = $id"; 
		//$ja->update($arr , $condition );
	
	
//	var_dump($_POST["application"]);
	 
}  
 
/*
	echo " <pre>";
	print_r($application);
	echo "</pre>";

$type = 1;
$application = 2;
$inc =0;

 
$questions = new Questions;
$questions->listAll();

$answers = new Questions;
$answers->getByType($type , $id);
*/
displayTrigger();
?>


<div id=content class=content>
<br><br>
<div class="errorContainer error-msg">
	<h4>Please fix the following before you can submit</h4>
</div>

 
<form method="POST" enctype="multipart/form-data" name="grade_form" id="addedit_employee_form" action="grade.php?id=<?php echo $_GET["id"]; ?>">
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
 
	$inc = 0;
foreach ($appquestions->data as $question)
{ 
	//echo $question["qtitle_en"] . "<br>";
	
		$mysheet->openSheetTableRow($question["id"]);
		$mysheet->addSheetCell(  $inc+1); 
		$mysheet->addSheetCell(  $question["qtitle_en"]); 
		$mysheet->addSheetCell( $question["value"]); 
		if ($question["grade"] > 0)
		{
			$data = "<select name=grading[".$question["idanswers"] ."][grade]>";
			for ($i = 0 ; $i <=$question["grade"]; $i++ )
				$data.= " <option value='$i'>$i</option>";
			$data .= "</select>";
			$mysheet->addSheetCell($data);   
		}else 
		$mysheet->addSheetCell(  "-");   
		$mysheet->closeSheetTableRow(); 
		
		$inc++; 
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