<?php 
include_once '../include/config.php';
include_once '../include/connection.php';
include_once '../include/functions.php';
include ("../include/header.php");

$id = isset($_GET["id"]) ? $_GET["id"] : 0;
// alais is always better than the ip for the SEO
$alias = isset($_GET["alias"]) ? $_GET["alias"] : "";

if ($id >  0 || $alias !=""):


$page = new Page();
$page->getByAlias($alias);
//$page->load($id);
 


?>
<div class="content">
	<?php 
	echo $page->row["content"];
	?>

</div>

<?php
endif;
include ("../include/footer.php");
?>
