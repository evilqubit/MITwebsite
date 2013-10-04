<?php
$this->breadcrumbs=array(
	'Mail Messages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MailMessage', 'url'=>array('index')),
	array('label'=>'Create MailMessage', 'url'=>array('create')),
	array('label'=>'View MailMessage', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MailMessage', 'url'=>array('admin')),
);
?>

<h1>Update MailMessage <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>