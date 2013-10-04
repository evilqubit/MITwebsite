<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Questions', 'url'=>array('index')),
	array('label'=>'Create Questions', 'url'=>array('create')),
	array('label'=>'Update Questions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Questions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Questions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'qtitle_en',
		'qtitle_ar',
		'qtitle_fr',
		'types_idtypes',
		'grade',
		'active',
		'ordering',
		'cTime',
		'cIpAddress',
		'cUserId',
	),
)); ?>
