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
  
$id = isset($_GET["id"])?clean($_GET["id"]) : 0; // id of selected page

$news = new news();
if ($id > 0)
{
	$news->load($id);  
}
else
{ 
	$news->reset();
}

// if the form was submitted
if(isset($_GET["action"]))
{  
	if($_GET["action"] == "add")
	{     
		    $news=new News;
			//$allNews=$news->addNews($_POST['intro'],$_POST['body'],$_SESSION['user_authorized']);
			$_POST["news"]["author"]= $_SESSION['user_authorized'];
			$news->insert($_POST["news"]);
			$banner_id= mysql_insert_id();
			if ($banner_id>0)	
			{	 
				setTrigger(_text("Data inserted successfully" , SUCCESS));
				header("Location: addEdit_news.php?id=$banner_id");
			}
		
	}
	else  
	{ 	// case of edit 
		$_POST["news"]["author"]= $_SESSION['user_authorized'];
		$news->update($_POST["news"]);
		//$news->updateNews($_POST['intro'],$_POST['body'],$_SESSION['user_authorized'],$id);
		setTrigger(_text("Data updated successfully" , SUCCESS));
			
 		/*$img_upd ="";
 		if($img !="")
 		{
 			$img_upd = " ,banner_src= '$img' ";
 		}
		$sql="
		UPDATE `banner` SET `banner_name` = '$banner_name'
			$img_upd, 
		`banner_description` = '$description' 
		WHERE `banner_id` =$banner_id LIMIT 1
		"; 
		mysql_query($sql) OR die(mysql_error());
		$success["Update"] = "Data updates successfully"; */
	}
	
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
<div id="errorContainer" class="errorContainer error-msg">
	<h4>الرجاء تصحيح الأخطاء التالية</h4>
</div>

<form method="POST" enctype="multipart/form-data" name="addedit_news_form" id="addedit_news_form" 
      action="addEdit_news.php?id=<?php echo $id; ?>&action=<?php echo ($id == 0 ? "add" : "edit");?>"> 
	<fieldset>
	<legend><?php echo _text("إعلانات");?></legend>
	<div class="fm-req">
		<label for="intro"><?php echo _text("العنوان:");?></label>
		<input type="text" id="intro" name="news[intro]" value="<?php echo $news->row["intro"]?>" required>
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
	<label for="body">النص:</label>

<?php 

$oFCKeditor = new FCKeditor('news[body]')  ;
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
<script >
 $(document).ready(function(){
	var container = $('div.errorContainer');
	// validate the form when it is submitted
	var validator = $("#addedit_news_form").validate({
		errorContainer: container,
		errorLabelContainer: container,
		rules: { 
			'news[intro]': {
				required: true,
			},
		},
		messages: { 
			'news[intro]': {
				required: "<?php echo _text("الرجاء إدخال العنوان");?>"
				
			}, 
			 
		}

		
	});



	
  });
</script>	 