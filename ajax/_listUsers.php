<?PHP
$users = new Users();
$users->listAll("idroles='".$id."'");
 
?>

<div class="clear10"></div>
<?php
$mysheet = new DataSheet();
$mysheet->tableStyleClass="";
$mysheet->openSheetTable("users",  "97%", 0,0 );
$mysheet->headerRowStyleClass = 'TableHeadersColorNass';

// set the displayed Fields with their widths
$fields	=	 array
(_text("الإسم"),_text("البريد الإلكتروني"),_text("الموقع الوظيفي"),_text("آخر دخول "));
$width = array('20%','30%','20%','20%'); 
$mysheet->addSheetTableHeader( $fields , $width,$tableheaderalign,1); 

foreach ($users->data as $user)
{   
	$mysheet->link="../Admin/view_user.php?id=".$user["iduser"];
	//$edit_link="../Admin/addEdit_user.php?id=".$user["iduser"];
	//$drop_link="../Admin/delete_user.php?id=".$user["iduser"];
	$mysheet->openSheetTableRow($user["iduser"]);
	// add the full name to the sheet and set the flag to true to enable linking to the edit staff page
	$mysheet->addSheetCell( $user["name"]);
	$mysheet->addSheetCell( $user["email"]);
	$mysheet->addSheetCell( $user["title"]);
	$mysheet->addSheetCell( $user["lastAccess"]);
	$mysheet->closeSheetTableRow();
}// end fors
$mysheet->closeSheetTable();
?>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#users').dataTable( {
			        "bJQueryUI": true,
			        "sPaginationType": "full_numbers"
				} );
			} );
</script>
		
