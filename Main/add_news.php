<?php
$pageId = "3"; 
$support= array("DataTables" =>false,"MD5"=>false ,"Editor"=>true);
$dataTables = 1; // support datatables js 
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/date_ar.php';
include_once '../include/functions.php';

// managers with either view / manage privileges can  view this page
//$actions = array("list_users","manage_users");
include ("../include/auth.php");
include ("../include/header.php");
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
<div class="left">
<?php 
  
	setlocale(LC_ALL,'ar');
	echo strftime('%A %d %B %Y'); 
	echo date("Y/m/d"); 
	?>
</div>

<div>
<form id="editForm"  name="addNews" method="post" action="../Main/add_news.php" >
<?php 
if(isset($_GET['id']))
{
    $id = clean($_GET["id"]);
	$newsId=new News;
	$newsById=$newsId->getNewsById($id);
	if (count($newsById)>0)
    { 
		foreach ($newsById as $n)
		{
			$introId=$n['intro'];
			$bodyId=$n['body'];
			//echo($bodyId);
			
		}
    }
}
?>	    
			      <div class="dataTitle right"><b><?php echo _text("intro" , "addNews");?>:</b></div>
			      <div><input name="intro" type="text" class="textfield right" id="intro" placeholder="<?php echo _text("intro" , "addNews");?>" value="<?php if(isset($_GET['id'])){echo($introId);} ?>"/></div>
			    <div class="clearR"></div>
			    
			      <div class="dataTitle right"><b><?php echo _text("body" , "addNews");?>:</b></div>
			      <div><textarea name="bodyold"  class="textfield  right" id="bodyold" placeholder="<?php echo _text("body" , "addNews");?>" ><?php if(isset($_GET['id'])){echo"$bodyId";}?></textarea></div>
			    <div class="clearR"></div>
			    <div>
			    <?php 
				    $oFCKeditor = new FCKeditor('body') ;
					$oFCKeditor->BasePath	= EDITOR_PATH ;
					if(isset($_GET['id']))
					{
						$oFCKeditor->Value="$bodyId";
					}
					else $oFCKeditor->Value='';
	                $oFCKeditor->ToolbarSet = 'Mini';
					$oFCKeditor->Create();
				?>
				</div>
		       	<div >&nbsp;</div>
		        <div ><input type="submit" class="submit right submitMargin" name="Submit" value="<?php echo _text("Send" , "addNews");?> >>" /></div>
	           <div class="clearR"></div>
</form>
</div>
<?php 
    if(isset($_GET['id']))
	 {
	 	if(isset($_POST['intro']))
	 	{
		 	$news=new News;
		 	$allNews=$news->updateNews($_POST['intro'],$_POST['body'],$_SESSION['user_authorized'],$id);
			echo("Edit");
	 	}
	 }
	else if(isset($_POST['intro']))
	{
			$news=new News;
			$allNews=$news->addNews($_POST['intro'],$_POST['body'],$_SESSION['user_authorized']);
			echo("Add");
	}
	  
?>
<?php 
include ("../include/footer.php");
?>