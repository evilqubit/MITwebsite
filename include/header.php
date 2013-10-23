<?php 
@session_start(); 

/*
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
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          
        <script src="../js/vendor/jquery.js"></script> 
        <script src="../js/vendor/jquery-ui.js"></script>  
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
			@import "../datatables/css/table_<?php echo $lang;?>.css?3";
			@import "../datatables/css/table_jui.css?1";
			</style>
			<script type="text/javascript" language="javascript" src="../datatables/js/jquery.dataTables.js"></script>
			<?php         	
        }
        ?>
        
        
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
        <link rel="stylesheet" type="text/css" href="../css/mit.css">

    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="logo"><img src="../images/logo.jpg"/></div>


                <div class="userNav">
                    <button class="btn-primary">Login</button>
                    <input type="text" class="search" id="search" placeholder="Type your search">
                    <i class="searchIcon">&nbsp;</i>
                </div>

                <div class="wrapper">
                    <div class="menu-holder">
                        <ul class="menu">
                            <li class=" home active" >
                                <a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="firstList">
                                <a href="../Main/page.php?alias=tracks">Tracks</a>
                            </li>
                            <li class="firstList">
                                <a href="javascript:void(0)">Judges & Coaches</a>
                                    <ul class="submenu judges">
                                        <li class="seperator"><a href="../Main/page.php?alias=round1">Round I</a></li>
                                        <li class="seperator"><a href="../Main/page.php?alias=round2">Round II</a></li>
                                        <li class="seperator"><a href="../Main/page.php?alias=round3">Round III</a></li>
                                        <li><a href="#">Coaches</a></li>
                                    </ul>
                            </li>
                            <li class="firstList">
                                <a href="javascript:void(0)">Judges & Coaches</a>
                                <ul class="submenu judges">
                                    <li class="seperator"><a href="#">Round I</a></li>
                                    <li class="seperator"><a href="#">Round II</a></li>
                                    <li class="seperator"><a href="#">Round III</a></li>
                                    <li><a href="#">Coaches</a></li>
                                </ul>
                            </li>
                            <li class="firstList"><a class="test" href="#">This is the one</a>

                                <ul class="submenu">
                                    <li><a href="#">Submenu item 1</a>
                                    </li>
                                    <li><a href="#">Submenu item 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="firstList"><a href="#">menu item 3</a>
                            </li>
                            <li class="firstList"><a href="#">menu item 4</a>
                            </li>
                        </ul>
                    </div>
                    <!-- menu-holder end -->
                </div>
 

            </div>
            <div class="news">
                <div class=""></div>
            </div>
        </div>
        
        
        

       	