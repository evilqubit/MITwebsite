<?php
$pageId = "1";
$page = "Home";
$page_title = "MITArabCompetition";
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("../include/header.php");

$user = new Users();
$user->getById(1);

 if (isset($_SESSION['showCaptcha']) && $_SESSION['showCaptcha']==true )
     { 
       header("location: ../Admin/login.php");
     } 
?> 
login page	
 
 <form class="navbar-form pull-right" id="loginForm" name="loginForm" method="post" action="../Admin/login-exec.php"> 
     <a href="../Admin/verify_email.php" title="هل نسيت كلمة السر؟" ><img src="../img/imgForget.png"></img></a>
     <input class="span2" required type="text"     placeholder="<?php echo _text("Login");?>" name="login" id="login" >
     <input class="span2" required type="password" placeholder="<?php echo _text("Password");?>" name="password" id="password">
     <button type="submit" class="btn"><?php echo _text("Sign in");?></button>            
  </form>

<?php
include ("../include/footer.php");
?>
