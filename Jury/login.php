<?php
$skipLogin = true;
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("jheader.php"); 
?>

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
</style>