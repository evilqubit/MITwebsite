<?php

require_once '../include/config.php'; 
include_once '../include/connection.php'; 
include ("../include/header.php");
 $news=new News;
 $detailNews=$news->getNewsById($_GET['idnews']);
?>

<?php 
 if (count($detailNews) > 0 )
 {
		foreach ($detailNews as $detail )
		{
			?>
				<div class="span4"><?php echo  $detail["body"];?></div> 
			<?php 
			
		}
 }
 else
 { ?>
	<a href="#"><?php echo  _text("Gone Missing in News :S");?></a>
 
	<?php 
 }	
 
include ("../include/footer.php"); 
?> 
 

