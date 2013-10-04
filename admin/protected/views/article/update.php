<?php
$this->breadcrumbs=array(
	'Pages'=>array('/pages'),
	'Articles'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'View Article', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Article <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>