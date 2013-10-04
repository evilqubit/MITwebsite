<?php
$this->breadcrumbs=array(
	'Pages'=>array('/pages'),
	'Newsletter Issues'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NewsletterIssue', 'url'=>array('index')),
	array('label'=>'Create NewsletterIssue', 'url'=>array('create')),
	array('label'=>'View NewsletterIssue', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update NewsletterIssue <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>