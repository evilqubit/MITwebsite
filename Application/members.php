<?php

include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
 
 
$_SESSION['error'] = "";
//$_SESSION['applicationId'] =2;
if($_SESSION['applicationId']){
	
$applicationId = $_SESSION['applicationId'];	
$member = new Members();
//$member->reset();
	
if(isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['uid']) && !empty($_GET['uid']) ){
	
	$action = $_GET['action'];
	$uid = $_GET['uid'];
	
}else{
	
	$action = 'add';
}
}else{
	header('location:login.php');
}


switch($action){
	
	case 'add': 
		if($_POST['submit']){
			$member->row = $_POST["members"];
			$id = $member->insertIFNE(); 
		
			if ($member->error)	
			{	 
				setTrigger(_text("Data Fail" , ERROR)); 
			}
			else 
			{
				setTrigger(_text("Data inserted successfully" , SUCCESS)); 
				
			} 
		}
    break;
		
	case 'edit':
		
		if($_POST['submit']){
			
			$member->row = $_POST["members"];
			$member->update();  
			
			if ($member->error)	
			{	 
				setTrigger(_text("Data Fail" , ERROR)); 
			}
			else 
			{
				setTrigger(_text("Data inserted successfully" , SUCCESS)); 
				
			} 
		
		}
		
		
		$member->load($uid);
		/*
		$editMember = getMember($uid);

		$fname =$editMember['lname'];
		$lname =$editMember['fname'];
		$birth = $editMember['birth'];
		$nationality = $editMember['nationality'];
		$major = $editMember['major'];
		$graduation =$editMember['graduation_year'];
		$phone =$editMember['phone'];
		$email =$editMember['email'];
		$background =$editMember['profectional_background'];
		$occupation =$editMember['current_occupation'];
		$education =$editMember['education'];
		$gender =$editMember['gender'];
		$other =$editMember['other_education'];
*/
		

	break;
	
	case 'delete':
		
		deleteMember($uid);
	break;	
		
	
}

 displayTrigger();  

?>


<script src="../js/vendor/jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->

<form action="members.php?action=<?php echo $action?><?php   echo (@$uid)?"&uid=".$uid:"" ?>" method="post" onsubmit="return validateMemberForm()">

	<input type="hidden" value="<?php echo $action;?>" name="action"/><br/>
	<input type="hidden" value="<?php echo $applicationId;?>" name="members[applicationId]"/>
	<input type="hidden" value="<?php echo $uid;?>" name="members[id]"/>
	
	first name:<input type="text" value="<?php  echo $member->row['fname'];?>" name="members[fname]" id="fname"/><br/>
	last name:<input type="text" value="<?php  echo $member->row['lname'];?>" name="members[lname]" id="lname"/><br/>
	Birth Date:<input type="text" value="<?php  echo $member->row['birth'];?>" name="members[birth]" id="birth"/><br/>
	nationality :<input type="text" value="<?php  echo $member->row['nationality'];?>" name="members[nationality]" id="nationality"/><br/>
	major:<input type="text" value="<?php  echo $member->row['major'];?>" name="members[major]" id="major"/><br/>
	Graduation Year:<input type="text" value="<?php  echo $member->row['graduation_year'];?>" name="members[graduation_year]" id="graduation"/><br/>
	phone:<input type="text" value="<?php  echo $member->row['phone'];?>" name="members[phone]" id="phone"/><br/>
	email:<input type="text" value="<?php  echo $member->row['email'];?>" name="members[email]" id="email"/><br/>
	Professional Background:<input type="text" value="<?php  echo $member->row['profectional_background'];?>" name="members[profectional_background]" id="background"/><br/>
	Current Occupation:	<input type="text" value="<?php  echo $member->row['current_occupation'];?>" name="members[current_occupation]" id="occupation"/><br/>
	
	
	Level of Education:<br/>
	
	<input type="radio" name="members[education]" value="phd" class="education" <?php echo ($member->row['education']=='phd')?'checked':'';?>/>Phd<br/>
	<input type="radio" name="members[education]" value="Bachelor"  class="education"  <?php echo ($member->row['education']=='Bachelor')?'checked':'';?>/>Bachelor<br/>
	<input type="radio" name="members[education]" value="master"  class="education"  <?php echo ($member->row['education']=='master')?'checked':'';?>/>master<br/>
	<input type="radio" name="members[education]" value="other"  class="education"  <?php echo ($member->row['education']=='other')?'checked':'';?>/>other<br/>
	
	<input type="text" name="members[other_education]" id="other" value="<?php echo $member->row['other_education'];?>"/><br/>
	
	
	Gender:<br/>
	<input type="radio" name="members[gender]" value="male" class="gender" <?php echo ($member->row['gender']=='male')?'checked':'';?>/>male<br/>
	<input type="radio" name="members[gender]" value="female"  class="gender" <?php echo ($member->row['gender']=='female')?'checked':'';?>/>female<br/>

	
	<input type="submit" name="submit" value="Submit" />
	<div id="ERROR"><?php echo $_SESSION['error'] ;?></div>
</form>

<?php 
$members = new Members();
$members->showActive()->getByApplicationId($applicationId);

//$appMembers = getAppMembers($applicationId);
if(is_array($members->data)){
foreach($members->data as $keys => $val){
?>

<?php echo $val['fname'].' '.$val['lname'];?> &nbsp;<a href="members.php?action=edit&uid=<?php echo $val['id']?>">edit</a>--<a href="members.php?action=delete&uid=<?php echo $val['id']?>">delete</a><br/>

<?php }}?>
<a href="members.php">Add other</a>
 
<script>
function isEmail(email) { 
    return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
} 

function validateMemberForm(){
	var error="";
	
	var lname = $('#lname').val();
	var fname = $('#fname').val();
	var email = $('#email').val();
	var nationality = $('#nationality').val();
	var major = $('#major').val();
	var birth = $('#birth').val();
	var graduation = $('#graduation').val();
	var phone = $('#phone').val();
	var background = $('#background').val();
	var occupation = $('#occupation').val();
	var other = $('#other').val();
	var education = $("input:radio[name='members[education]']:checked").val();
	var gender = $( "input:radio[name='members[gender]']:checked").val();


	if(birth =='' || background =='' || phone=="" || nationality =='' || lname=="" || fname=="" || major=="" || graduation=="" ||  email=="" || gender ==undefined || education ==undefined ||occupation=="" ){
          error = "All fields are required";
          $('#ERROR').html('').html(error);
          return false;
		}else if(!isEmail(email)){
	      error = "Invalid email";
	      $('#ERROR').html('').html(error);
	      return false;
		}else if(education == 'other' && other == ''){
         error = "other education fiel empty";
         $('#ERROR').html('').html(error);
         return false;
			}
	
}

</script>
