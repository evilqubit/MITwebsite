<?php
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("jheader.php"); 

$idjury = $_SESSION['user_authorized'];
$application = new Application();
//$application->listAll();
$application->getByJury($idjury);
?>
<br><br><br> 
<?php 
  /*
		echo " <pre>";
		print_r($application);
		echo " </pre>";
	*/	
// create the table
if ($application->data)
{
	$mysheet = new DataSheet();
	$mysheet->tableStyleClass="";
	$mysheet->openSheetTable("applications",  "98%", 0,0 );
	$mysheet->headerRowStyleClass = 'TableHeadersColorNass';
	
	// set the displayed Fields with their widths
	$fields	= array(_text("ID"),_text("Company Name"),_text("Industry"),_text("lang"),_text("Company City"),_text("Status"), _text(" Average Grade"),_text("Actions"));
	$width = array('10px;','','' , ''); 
	$mysheet->addSheetTableHeader( $fields , $width,"center" ,1); 
	
	foreach ($application->data as $app)
	{   
		$mysheet->link ="grade.php?id=".base64_encode($app["id"]);   
		$app["companyName"] = $app["companyName"]==""? "-" :$app["companyName"];
		$mysheet->openSheetTableRow($app["id"]);
		// add the full name to the sheet and set the flag to true to enable linking to the edit staff page
		$mysheet->addSheetCell( $app["id"]); 
		$mysheet->addSheetCell( $app["companyName"]." xxxx",true); 
		$mysheet->addSheetCell( $app["industrySection"]); 
		$mysheet->addSheetCell( print_language (print_language ($app["lang"]))); 
		$mysheet->addSheetCell( ); 
		$mysheet->addSheetCell(); 
		$mysheet->addSheetCell();  
		$mysheet->addSheetCell( $mysheet->makeCellEdit($mysheet->link)); 
		
	 
		
		$mysheet->closeSheetTableRow();
	}// end fors
	$mysheet->closeSheetTable();
} 
include ("jfooter.php");
?> 
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() { 
		$('#applications').dataTable( { 
			"aaSorting": [[ 3, "desc" ]], 
			"iDisplayLength": 10
		} ); 
		
	} ); 
</script>