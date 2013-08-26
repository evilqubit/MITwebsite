<?php
$pageId = "3"; 
$support= array("DataTables" =>true,"MD5"=>true ,"Editor"=>false);
$support["DataTables"]=1; // support datatables js 
include_once '../include/config.php';
include_once '../include/connection.php';
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
<div class="right addLink" >
إضافة إعلان:<a href="../Main/addEdit_news.php">
<img class="cursorStyle" border="0" title="Add" src="../img/b_add.png">
</a>
</div>
<div class="clear10"></div>
<?php
if ($auth->canDo("add_news"))
{
	$manage = true;
}
else
	$manage = false;
$news=new News;
$limit=5;
$allNews=$news->showInactive()->listAll();
if (count($allNews)>0)
{ 
    $mysheet = new DataSheet();
	$mysheet->tableStyleClass="";
	$mysheet->openSheetTable("news",  "100%", 0,0 );
	$mysheet->headerRowStyleClass = 'TableHeadersColorNass';
	
	// set the displayed Fields with their widths
	$fields	= array(_text("عنوان"),_text("الموضوع"),_text("فعال"),_text("تعديل"),_text("إلغاء"),_text("تفعيل/تعطيل "));
	$width = array('20%','50%','8%','8%','8%','5%'); 
	$mysheet->addSheetTableHeader( $fields , $width,$tableheaderalign,1); 
	
	foreach ($allNews as $new)
	{
		    $edit_link="../Main/addEdit_news.php?id=".$new["idnews"];
		    $drop_link="../Main/delete_news.php?id=".$new["idnews"];
			$mysheet->link="../_getNews.php?idnews=".$new["idnews"]; 
			$mysheet->openSheetTableRow($new["idnews"]);
			// add the full name to the sheet and set the flag to true to enable linking to the edit staff page
			$mysheet->addSheetCell($new["intro"]);
			$mysheet->addSheetCell($new["body"]);
			$mysheet->addSheetCell($new["active"]? "yes" : "no");
			if ($manage)
				$mysheet->addSheetCell( $mysheet->makeCellEdit($edit_link));
			else 
				$mysheet->addSheetCell( $mysheet->makeCellEdit("-"));
						
			if ($manage)
				$mysheet->addSheetCell( $mysheet->makeCellDelete($new["idnews"], "delete_news"));
			else 
				$mysheet->addSheetCell( $mysheet->makeCellDelete("-"));
			
			if ($manage)
				$mysheet->addSheetCell( $mysheet->makeCellActive($new["idnews"], "activate_news",$new["active"]? 0 : 1,$new["idnews"]));
			else 
				$mysheet->addSheetCell("-");
				
				
			 $mysheet->closeSheetTableRow();
	}// end fors
		$mysheet->closeSheetTable();
	 
}

include ("../include/footer.php");
?>
<script type="text/javascript" charset="utf-8">
		function delete_news(id)
		{ 
			if(confirm ('<?php echo _text("Confirm Delete" , "JS") ?>'))
			{    
				 var object= "news";
				 var hash = CryptoJS.MD5("<?php echo HASH_KEY?>"+id+object);
					
				$.ajax({
					  type: "post",
					  url: "../ajax/_delete.php",
					  data: {
					    id: id , object:object,hash:hash+""
					  },
					  success: function(data) {
					    console.log(data);
                  		$('#news').dataTable().fnDeleteRow( $('#news'+id) );
					  }
					}); 
			}
		}
	
		function activate_news(id)
		{ 
			     var flag=  $("#flag"+ id).val();
			     var object= "news";
			     var hash = CryptoJS.MD5("<?php echo HASH_KEY?>"+id+object);
				$.ajax({
					  type: "post",
					  url: "../ajax/_activate.php",
					  data: {
					    id: id,object:object,flag:flag,hash:hash+""
					  },
					  success: function(data) {
						     if(flag==1)$("#active"+id).attr("src", "../img/activate.png");
						     else $("#active"+id).attr("src", "../img/deactivate.png"); 
							 
						     $("#flag"+ id).val( (parseInt(flag) + 1) %2);
					    console.log(data);
					  }
					}); 
			
		}
			$(document).ready(function() {
				$('#news').dataTable( {
			        "bJQueryUI": true,
			        "sPaginationType": "full_numbers"
				} );
			} );
</script>
