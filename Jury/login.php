<?php
$skipLogin = true;
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title><?php echo _text("Jury Portal", "Jury");?></title>
	
	<link rel="shortcut icon" href="/favicon.ico"> 
		        
		        <!--  jquery ui -->
	<script src="../js/vendor/jquery-1.9.1.min.js"></script>
    <script src="../js/vendor/jquery-ui.js"></script> 
    <link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.css"> 
    <link rel="stylesheet" href="../css/jury.css"> 
    
    
	<!--  Datatables -->  	
	<style type="text/css" title="currentStyle">
	@import "../datatables/css/page.css";
	@import "../datatables/css/table_en.css?3";
	@import "../datatables/css/table_jui.css?1";
	</style>
	<script type="text/javascript" language="javascript" src="../datatables/js/jquery.dataTables.js"></script>

</head> 
<body>
<div id="demo-top-bar">

  <div id="demo-bar-inside">
 

    <h2 id="demo-bar-badge">
      <?php echo _text("MIT Jury Portal", "Jury");?>
    </h2>
    <div id="demo-bar-buttons">
    	<a class="header-button" href="../index.php">Back Home</a>
 
                
    </div> 
  </div>

</div>  

<div class="clear10"></div>
<div class="clear"></div>
	<form id="login-form" action="login-exec.php" method="post">
		<fieldset>
		
			<legend>Log in</legend>
			
			<label for="login">Login</label>
			<input type="text" id="login" name="login" value="<?php echo isset($_SESSION['login'])?$_SESSION['login']:"";?>"/>
			<div class="clear"></div>
			
			<label for="password">Password</label>
			<input type="password" id="password" name="password"/>
			<div class="clear"></div>
			
			<label for="password">Captcha</label>
				 <img class="imgAlign" src="../include/captcha.php" /></div>
				<input class="span2" name="captcha" type="text"> 
				 
			<div class="clear"></div>
			
			 <!-- 
			<label for="remember_me" style="padding: 0;">Remember me?</label>
			<input type="checkbox" id="remember_me" style="position: relative; top: 3px; margin: 0; " name="remember_me"/> -->
			<div class="clear"></div>
			
			<br />
			<input type="submit" style="margin: -20px 0 0 287px;" class="button" name="commit" value="Log in"/>	
		</fieldset>
	</form>
	
<?php  
include ("jfooter.php");
?>
<style>
body{ font-family: Georgia, serif; background: url(images/login-page-bg.jpg) top center no-repeat #c4c4c4; color: #3a3a3a;  }

form				{ width: 790px; margin: 91px auto 0; }

fieldset			{ border: 0;  margin-left: 136px;
    width: 478px; } 
  
</style>