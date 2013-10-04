<?php
$this->menu = array(
    array('label'=>'All Newsletters', 'url'=>array('index')),
    array('label'=>'Manage Subscribers', 'url'=>array('subscriber/index')),
);
?>
<h2>Update Newsletter</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
