<?php
$this->breadcrumbs=array(
    'Newsletter'=>array('admin/index'),
	'Subscribers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Subscribers', 'url'=>array('index')),
);
?>

<h1>Add Newsletter Subscriber</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>