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

        <div class="content">
            <div style="height:200px;"></div>
        
        </div>
      <!--  
      Nick's front page
       -->  
       <?php 
       /*
       ?>
        <div class="content">
            <div id="timeline-embed"></div>
            <script type="text/javascript">
                var timeline_config = {
                    width:              '100%',
                    height:             '600',
                    source:             'example_jsonp.jsonp',
                    embed_id:           'timeline-embed',               //OPTIONAL USE A DIFFERENT DIV ID FOR EMBED
                    start_at_end:       false,                          //OPTIONAL START AT LATEST DATE
                    start_at_slide:     '4',                            //OPTIONAL START AT SPECIFIC SLIDE
                    start_zoom_adjust:  '1',                            //OPTIONAL TWEAK THE DEFAULT ZOOM LEVEL
                    hash_bookmark:      true,                           //OPTIONAL LOCATION BAR HASHES
                    debug:              true,                           //OPTIONAL DEBUG TO CONSOLE
                    lang:               'en',                           //OPTIONAL LANGUAGE
                    maptype:            'watercolor',                   //OPTIONAL MAP STYLE
                    css:                'css/timeline.css',     //OPTIONAL PATH TO CSS
                    js:                 'js/timeline-min.js'    //OPTIONAL PATH TO JS
                }
            </script>
            <script type="text/javascript" src="../js/storyjs-embed.js"></script>
        </div>
 */
       ?>
<?php /*?>
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
*/

?><!--  -->
<?php
include ("../include/footer.php");
?>
