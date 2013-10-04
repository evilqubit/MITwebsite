<?php
$pageId = "1";
$page = "Home";
$page_title = "MITArabCompetition";
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("../include/header.php");

 if (isset($_SESSION['uid']) && $_SESSION['uid'] >  0)
{  
	
$user = new Users();
$user->getById($_SESSION['uid']);
	
} 
?>  
 <form class="navbar-form pull-right" id="loginForm" name="loginForm" method="post" action="../Application/login.php"> 
     <a href="../Application/forgot_password.php" title="هل نسيت كلمة السر؟" ><img src="../img/imgForget.png"></img></a>
     <input class="span2" required type="text"     placeholder="<?php echo _text("Login");?>" name="username" id="username" >
     <input class="span2" required type="password" placeholder="<?php echo _text("Password");?>" name="password" id="password">
     <button type="submit" class="btn"><?php echo _text("Sign in");?></button>            
  </form>
  
  
  <br><Br>
  
  <hr>
  <ul>
  	<li><a href="../Application/register.php" ></a></li>
  	<li></li>
  	<li></li>
  </ul>

<?php
include ("../include/footer.php");
?>
