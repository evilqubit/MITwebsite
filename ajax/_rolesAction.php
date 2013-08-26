<?php 
$supressFireBug =true;
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("../include/auth.php");
$id = isset($_GET["idrole"]) ?clean($_GET["idrole"]) : 0;
$idaction = isset($_GET["idaction"]) ?clean($_GET["idaction"]) : 0;
@$flag = $_GET["flag"]; 
//var_dump($flag);
if ($id>0)
{   
    if($flag=="true")
    {
    	$data = array();
		$rolesaction=new Roles_action();
		$data["roles_idroles"] = $id;
		$data["action_idaction"] = $idaction;
		$rolesaction->insert($data); 
    }
    else{$rolesaction=new Roles_action();$rolesaction->purgeAll("roles_idroles='" .$id."'and action_idaction='".$idaction."'"); 
     }
     
//    var_dump($rolesaction);
    $role = new Roles();
	$RoleActions=$role->getRoles_Action($id);
	if(count($RoleActions)>0)
	{
		foreach ($RoleActions as $val)
		{		 
			$allowed[$val['idaction']]=true; 
			
		}
	}
	
	$users = new Users();
    $users_role=$users->listAll("idroles='".$id."'");
    if(count($users_role)>0)
	{
		foreach ($users_role as $val)
		{		 
			$allowedUsers[$val['iduser']]=true; 
			
		}
	}
    
}
$action = new Action();
$allActions=$action->listWithCategory();
if (count($allActions)>0)
   {?>    
        <fieldset>
		<h1 class='right'><?php echo _text("المهام:");?></h2>
		<div class="clear10"></div>
		<div id=actionBoxes>
		<?php 	 
		$category =-1;
		foreach ($allActions as $action)
		{  
			echo  ($action['idcategory']!= $category) ?  ("<div class='clear'></div><h2 class='right'>".( (!isset($action['name']) ) ? _text("Others") :$action['name'] ) ."</h2><div class='clear10'></div>" ):"";
			$category=$action['idcategory'];
		?>
		 
			<label>
			  <input class="myClass" <?php echo isset($allowed[$action['idaction']]) ? "checked" :"";?> type="checkbox" 
			       onClick="saveActions(<?php echo $action['idaction'];?>,<?php echo isset($allowed[$action['idaction']])? "0" :"1"; ?>)"
			     name="action[<?php echo $action['idaction'];?>]" id="<?php echo $action['idaction'];?>" value="<?php echo $action['idaction'];?>"  />
			     <label><?php echo $action['title'];?></label><br/>
			 </label>
		 				
 		<?php 
		}?>
		</div>
		</fieldset>
		<?php 
      }
      include_once '../ajax/_listUsers.php';
 ?>


<script>
$(document).ready(function(){

	// styling the checkboxes
	$('input.myClass').prettyCheckable({
	    color: 'gray'
	  });


	// preserving the saveaction function on the save checkbox
	//$('input.myClass').on('change', saveActions);
	
	$('input.myClass').change(function () {
		saveActions($(this).attr('value'),$(this).prop('checked'));
	    // ...
	   // console.log($(this).attr('value') + ": " + $(this).prop('checked'));
	    // ...
	});

  });


function saveActions(idaction ,flag)
{       var idrole=<?php echo $id;?>; 
	    $.ajax({
			  type: "get",
			  url: "../ajax/_rolesAction.php",
			  data: {
	    	       idrole: idrole,
	    	       idaction: idaction,
	    	       flag:flag
			  },
			  success: function(data) {
	               //console.log(data);
	               $('#rolesAction').html(data);
	               
			  }
			}); 
	
}
</script>
