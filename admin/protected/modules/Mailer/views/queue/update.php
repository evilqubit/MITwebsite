<?php
$this->breadcrumbs=array(
	'Mail Messages'=>array('index'),
    'Message #'.$model->messageId=>array('message/view', 'id'=>$model->messageId),
	'Queue #'.$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>'All Mail Messages', 'url'=>array('message/index')),
	array('label'=>'View Mail Queue', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Back to Mail Message', 'url'=>array('message/view', 'id'=>$model->messageId)),
);
?>

<h1>Update Mail Queue <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>