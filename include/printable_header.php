<?php 
@session_start(); 
if (isset($pageId) && $pageId!="" )
{
 	$sql = "select * from pages where page_id = '$pageId'";
 	$result = mysql_query($sql);
 	if ($result)
 	{
 		$row = mysql_fetch_array($result); 
 		$page_title = $row["meta_title"];
 		$page_title = $row["meta_description"];
 		$page_title = $row["meta_keyword"];
 	}
}
?>
 <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width"> 
        <link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="../css/bootstrap_<?php echo $lang;?>.css">
        <link rel="stylesheet" href="../css/printable.css?3">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="../css/bootstap-responsive_<?php echo $lang;?>.css">
        <link rel="stylesheet" href="../css/main_<?php echo $lang;?>.css">
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <?php 
        if(isset($support["MD5"])&& $support["MD5"]):
        ?>
        	<script src="../js/vendor/core-min.js"></script>
        	<script src="../js/vendor/md5-min.js"></script> 
        <?php 
        	endif;       
        ?> 
		<script src="../js/vendor/jquery-1.9.1.min.js"></script>
		<!--  Jq validator	 -->
		<script type="text/javascript" src="../js/vendor/jquery.validate.min.js"></script>
		
		
		<!-- Add mousewheel plugin (this is optional) -->
		<script type="text/javascript" src="../js/vendor/jquery.mousewheel-3.0.6.pack.js"></script>
		
        <script src="../js/vendor/jquery-ui.js"></script>
        <script src="../js/vendor/bootstrap.min.js"></script>

         <!-- jQuery File Upload Dependencies -->
        <script src="../js/vendor/js_upload/jquery.ui.widget.js"></script>
        <script src="../js/vendor/js_upload/jquery.iframe-transport.js"></script>
        <script src="../js/vendor/js_upload/jquery.fileupload.js"></script>
		
        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
        <!-- jQuery prettyCheckable -->
        <link rel="stylesheet" href="../css/prettyCheckable.css">
        <script src="../js/vendor/prettyCheckable.js"></script>
        
        <?php 
        if(isset($support["ComboBox"])&& $support["ComboBox"]):
        ?>
        	<script src="../js/combo.js"></script> 
        <?php 
        	endif;       
        ?>
        
        
        <?php  
        if (isset($support["DataTables"])&& $support["DataTables"])
        {
        	?>			        	
			<style type="text/css" title="currentStyle">
			@import "../datatables/css/page.css";
			@import "../datatables/css/table_<?php echo $lang;?>.css?2";
			@import "../datatables/css/table_jui.css?1";
			</style>
			<script type="text/javascript" language="javascript" src="../datatables/js/jquery.dataTables.js"></script>
			<?php         	
        }
        ?>
        
        
   </head>
  
    <body onload="window.print()" >
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
 
        <div class="container mainContainer" align="center"> 

 			