<?php
@session_start();
$loggedin = false;
if (!isset($skipLogin))
{
	// check if the jurey is logged in or not
	if (!isset($_SESSION['auth']) || $_SESSION['auth'] == false)
	{
		// not logged in reditect to the login page
		header("Location: ../Jury/login.php");
	}
	else
	{
		
		$loggedin=true;
	}
}
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
    	<?php 
    	if ($loggedin)
    	{
    		?>
    		<a class="header-button" href="../index.php?logout=true">logout</a>
    		<?php 
    	}
    	?> 
                
    </div> 
  </div>

</div>  