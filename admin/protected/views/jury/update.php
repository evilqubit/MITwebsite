<?php
$this->breadcrumbs=array(
	'Juries'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jury', 'url'=>array('index')),
	array('label'=>'Create Jury', 'url'=>array('create')),
	array('label'=>'View Jury', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Jury <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>