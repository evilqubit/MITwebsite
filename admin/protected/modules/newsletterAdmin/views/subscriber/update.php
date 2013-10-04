<?php
$this->breadcrumbs=array(
	'Newsletter Subscribers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subscribers', 'url'=>array('index')),
    array('label'=>'Manage Newsletters', 'url'=>array('admin/index')),
    array('label'=>'View Subscriber', 'url'=>array('view', 'id'=>$model->id)),
);
if($this->module->backendAddSubscriber) $this->menu[] = array('label'=>'Add Subscriber', 'url'=>array('create'));
?>

<h1>Update Newsletter Subscriber <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>