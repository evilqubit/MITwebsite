<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

<?php
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';

$type = isset($_GET['type']) ?  $_GET['type'] : 1 ;


$countries = array('Algeria','Bahrain','Comoros','Egypt','Iraq','Jordan','Kuwait','Lebanon','Libya','Mauritania','Morocco','Somalia','Djibouti','Yemen','Oman'.'Sudan','UAE','Suadi Arabia','Qatar','Syria','Palestine','Tunisia');


$sOutput .= '<div id="register-body">';

if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		case 'register':
			
			/*Array ( [type] => 1 [username] => sfd [password] => 12345 [confim_password] => 12345 [fname] => dfdgd [lname] => dfdsgd 
					[email] => ahmad-rahal@live.com [country] => Algeria [competition] => 2 [lang] => ar [submit] => Register! )*/
			
			// If the form was submitted lets try to create the account
			
			
			
			if (isset($_POST['username']) && isset($_POST['password'])) {
				
				$post_data = array();
				
				$post_data['type'] = $_POST['type'];
				$post_data['username'] = $_POST['username'];
				$post_data['password'] = $_POST['password'];
				$post_data['fname'] = $_POST['fname'];
				$post_data['lname'] = $_POST['lname'];
				$post_data['email'] = $_POST['email'];
				$post_data['country'] = $_POST['country'];
				$post_data['competition'] = $_POST['competition'];
				$post_data['lang'] = $_POST['lang'];
				
				if (createAccount($post_data))
				 {
					$sOutput .= '<h1>Account Created</h1><br />Your account has been created. 
								You can now login <a href="login.php">here</a>.';
				}else {
					// unset the action to display the registration form.
					unset($_GET['action']);
				}				
			}else {
				$_SESSION['error'] = "Username and or Password was not supplied.";
				unset($_GET['action']);
			}
		break;
	}
}

// If the user is logged in display them a message.
if (loggedIn()) {
	$sOutput .= '<h2>Already Registered</h2>
				You have already registered and are currently logged in as: ' . $_SESSION['username'] . '.
				<h4>Would you like to <a href="login.php?action=logout">logout</a>?</h4>
				<h4>Would you like to go to <a href="index.php">site index</a>?</h4>';
				
// If the action is not set, we want to display the registration form
}elseif (!isset($_GET['action'])) {
	// incase there was an error 
	// see if we have a previous username
	$sUsername = "";
	$fname = "";
	$lname = "";
	$email = "";
	$country = "";
	$competition = "";
	$lang = "";
	
	
	if (isset($_POST['username'])) {
		
		$sUsername = $_POST['username'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$country = $_POST['country'];
		$competition = $_POST['competition'];
		$lang = $_POST['lang'];
	}
	
	$sError = "";
	if (isset($_SESSION['error'])) {
		$sError = '<span id="ERROR" style="color:red">' . $_SESSION['error'] . '</span><br />';
	}
	
	$sOutput .= '<h2>Register for this site</h2>
		' . $sError . '
		<form name="register" method="post" action="' . $_SERVER['PHP_SELF'] . '?action=register" onsubmit="return validateForm();">
	     	<input type="hidden" name="type" id="type" value="'. $type.'"/>   
			Username: <input type="text" name="username"  id="username" value="' . $sUsername . '" /><br />
			password: <input type="password" name="password" id="password" value="" /><br /><br />
			Confirm password: <input type="password" id="confirmpassword" name="confim_password" value="" /><br /><br />
			First Name: <input type="text" name="fname" id="fname" value="'.$fname.'" /><br /><br />
			Last Name: <input type="text" name="lname" id="lname" value="'.$lname.'" /><br /><br />
			E-mail: <input type="text" name="email" id="email" value="'.$email.'" /><br /><br />
			Country: 
			
				  <select name="country" id="country" >';
						foreach($countries as $keys =>$values){
							if($country){
							if($country==$values){
								
								$sel ="selected='selected'";
							}
							else {
								$sel = '';
							 }
							}
							else if($values=='Lebanon'){
								
								$sel ="selected='selected'";
							}else {
								$sel = '';
							 }
							
							$sOutput .="<option value='".$values."' ".$sel.">".$values."</option>";
						}
                $sOutput .= '  </select>
			
			
			<br /><br />
			            How did you learn about the Competition ?<br />
			
			            <div class="Radio"> ';
                
                        if($competition==1){
                        	$checked == "checked='checked'";
                        }else{
                        	$checked == "";
                        }
                        
                        $sOutput .= '<input type="radio" name="competition" id="jordan" value="1" '.$checked.'/>';
                        $sOutput .= '<span>Launch Event in Jordan</span>
                         </div>
                        
                        <div class="Radio">';
                        
                        if($competition==2){
                        	$checked == "checked='checked'";
                        }else{
                        	$checked == "";
                        }
                        
                       $sOutput .= '<input type="radio" name="competition" id="qatar" value="2" '.$checked.'/>';
                       $sOutput .= '<span>Launch Event in Qatar</span>
                        </div>
                        
                        <div class="Radio">';
                        
                       if($competition==3){
                       	$checked == "checked='checked'";
                       }else{
                       	$checked == "";
                       }
                        $sOutput .= '<input type="radio" name="competition" id="website" value="3" '.$checked.'/>';
                        $sOutput .= '<span>MIT Enterprise Forum Website</span>
                        </div> 
                        
						<div class="Radio">';
                        
                        if($competition==4){
                        	$checked ==  "checked='checked'";
                        }else{
                        	$checked == "";
                        }
                        $sOutput .= '<input type="radio" name="competition" id="tv" value="4" '.$checked.'/>';
                        $sOutput .= '<span>TV</span>
                        </div>
                        
			
			<br /><br />
			
			
			
			Your Application will be written in: <br />
			
			          <div  class="Radio">';
                        
                        if($lang=='en'){
                        	$checked ="checked";
                        }else{
                        	$checked = "";
                        }
                       $sOutput .= '<input type="radio" name="lang" id="english" value="en" '.$checked.'/>';
                        
                       
                       $sOutput .= '<span>English</span>
                      </div>
                       
                      <div  class="Radio">';
                       
                       if($lang=='fr'){
                       	$checked ="checked";
                       }else{
                       	$checked = "";
                       }
                        $sOutput .= ' <input type="radio" name="lang" id="french" value="fr" '.$checked.'/>';
                        $sOutput .= '<span>French</span>
                      </div>
                      
                      <div  class="Radio">';
                        
                        
                        if($lang=='ar'){
                        	$checked ="checked";
                        }else{
                        	$checked = "";
                        }
                        $sOutput .= '<input type="radio" name="lang" id="arabic" value="ar" '.$checked.'/>';
                        $sOutput .= '<span>Arabic</span>
                      </div>
			
			
			<br /><br />
			<input type="submit" name="submit" value="Register!" />
		</form>';
}

$sOutput .= '</div>';

// display our output.
echo $sOutput;
?>




<script>
function isEmail(email) { 
    return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
} 

function validateForm(){
	var error="";
	var username = $('#username').val();
	var lname = $('#lname').val();
	var fname = $('#fname').val();
	var password = $('#password').val();
	var confirmpassword = $('#confirmpassword').val();
	var email = $('#email').val();
	var lang = $("input:radio[name='lang']:checked").val();
	var competition = $( "input:radio[name='competition']:checked").val();


	
	var country = $('#country').val();

	if(username =='' || lname=="" || fname=="" || password=="" || confirmpassword=="" ||  email=="" || lang ==undefined || competition ==undefined ||country=="" ){
          error = "All fields are required";
          $('#ERROR').html('').html(error);
          return false;
		}else if(!isEmail(email)){
	      error = "Invalid email";
	      $('#ERROR').html('').html(error);
	      return false;
		}else if(password != confirmpassword){
         error = "Confirm Password and Password not equal ";
         $('#ERROR').html('').html(error);
         return false;
			}
	
}

</script>





