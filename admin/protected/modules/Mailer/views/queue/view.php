<?php
$this->breadcrumbs=array(
	'Mail Messages'=>array('index'),
    'Message #'.$model->messageId=>array('message/view', 'id'=>$model->messageId),
	'Queue #'.$model->id,
);

$this->menu=array(
    array('label'=>'All Mail Messages', 'url'=>array('message/index')),
	array('label'=>'Update Mail Queue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mail Queue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Back to Mail Message', 'url'=>array('message/view', 'id'=>$model->messageId)),
);
?>

<h1>View Mail Queue #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'to',
		'toName',
		'messageId',
		'status',
        array(
            'label'=>'Status Name',
            'value'=>$model->statusName,
        ),
        'error',
		'active',
		'deleted',
		'cTime',
		'cIpAddress',
	),
)); ?>
