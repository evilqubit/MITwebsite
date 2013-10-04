<?php
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("../include/header.php");


?>
<form id="loginForm" name="loginForm" method="post" action="../Admin/login-exec.php"> 
 <div class="hero-unit">
    <div class="middleAlign">
       <div><?php echo _text("Login");?><input class="span2" required type="text"     placeholder="<?php echo _text("Login");?>" name="login" id="login" value="<?php echo isset($_SESSION['login'])?$_SESSION['login']:"";?>" ></div>
       <div><?php echo _text("Password");?><input class="span2" required type="password" placeholder="<?php echo _text("Password");?>" name="password" id="password"></div>
       <!--  <div id="forget"> <a href="../Admin/verify_email.php" ><?php echo _text("هل نسيت كلمة السر؟");?></a></div> -->     
       <div class="indent"><?php echo _text("أدخل الرمز");?><input class="span2" name="captcha" type="text"><img class="imgAlign" src="../include/captcha.php" /></div>   
       <div ><button type="submit" class="btn"><?php echo _text("Sign in");?></button></div>
      </div>
</div>      
</form>
<?php 

include ("../include/footer.php");
?>