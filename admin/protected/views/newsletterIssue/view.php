<?php
$this->breadcrumbs=array(
	'Pages'=>array('/pages'),
	'Newsletter Issues'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List NewsletterIssue', 'url'=>array('index')),
	array('label'=>'Create NewsletterIssue', 'url'=>array('create')),
	array('label'=>'Update NewsletterIssue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NewsletterIssue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View NewsletterIssue #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'link',
		'img',
		'active',
		'ordering',
		'cTime',
		'cIpAddress',
		'cUserId',
	),
)); ?>
