<?php
$this->breadcrumbs=array(
	'Juries'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Jury', 'url'=>array('index')),
	array('label'=>'Create Jury', 'url'=>array('create')),
	array('label'=>'Update Jury', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Jury', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Jury #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'login',
		'email', 
		'lang',
		'active',
		'ordering',
		'cIpAddress',
		'cTime', 
	),
)); ?>
