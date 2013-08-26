<?php
$pageId = "2";  
$support= array("DataTables" =>false,"MD5"=>false ,"Editor"=>true);
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
// managers with either view / manage privileges can  view this page
$actions = array("manage_employee");
include ("../include/auth.php");
include ("../include/header.php");
  
$id = isset($_GET["id"]) ?clean($_GET["id"]) : 0; // id of selected page

$news = new news();
if ($id > 0)
{
	$news->load($id);  
}
else
{ 
	$news->reset();
}
?>
<!--  Bread Crumb -->	
<ul class="bread" id="bread">
	<li><a href="../Admin/profile.php" ><?php echo _text("Management" , "Bread")?></a></li>
	<li><a href="../Employee/list_employees.php" >التحكم بالموظفين</a></li>
	<?php 
	if($id > 0)
	{
		?> 
			<li><?php echo $employee->get_name(); ?></li>
		<?php 
	}
	else
	{ 
		?> 
			<li><?php echo _text("add employee");?></li>
		<?php 
	}
	?>
</ul>
<form> 
	<fieldset>
	<legend><?php echo _text("إعلانات");?></legend>
	<div class="fm-req">
		<label for="fm-firstname"><?php echo _text("العنوان:");?></label>
		<input type="text" id="fm-firstname" name="fm-firstname" value="<?php echo $news->row["intro"]?>">
	</div> 
	
	<!-- 
	<div class="clear10"></div>
	<div class="fm-req">
	<label for="fm-lastname"><?php echo _text("title");?></label>
	<input type="text" id="fm-lastname" name="fm-lastname">
	</div>
	<div class="clear10"></div>
	<div class="fm-opt">
		<label for="fm-middlename">optional filed</label>
		<input type="text" name="fm-middlename" id="fm-middlename">
	</div>
	 -->
	<div class="clear10"></div>
	
	<div class="fm-req">
	<label for="fm-lastname">النص:</label>

<?php 

$oFCKeditor = new FCKeditor('FCKeditorMini')  ;
$oFCKeditor->BasePath	= EDITOR_PATH ;
$oFCKeditor->ToolbarSet = 'Mini';
$oFCKeditor->Value = $news->row["body"] ;
$oFCKeditor->Create() ;
?>
</div>


<div >&nbsp;</div>
<div ><input type="submit" class="submit right submitMargin" name="Submit" value="<?php echo _text("Send" , "addNews");?> >>" /></div>
<div class="clearR"></div>
	           
</fieldset>
</form>

<?php 
/*
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= EDITOR_PATH ;
$oFCKeditor->Value		= '' ;
$oFCKeditor->Create() ;


$oFCKeditor = new FCKeditor('FCKeditorMini') ;
$oFCKeditor->BasePath	= EDITOR_PATH ;
$oFCKeditor->ToolbarSet = 'Mini';
$oFCKeditor->Value		= '' ;
$oFCKeditor->Create() ;
*/
include ("../include/footer.php");
?>
	 