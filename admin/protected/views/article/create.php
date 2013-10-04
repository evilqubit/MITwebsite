<?php
$this->breadcrumbs=array(
	'Pages'=>array('/pages'),
	'Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
);
?>

<h1>Create Article</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>