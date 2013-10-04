<?php
$this->breadcrumbs=array(
	'Pages'=>array('/pages'),
	'Newsletter Issues'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NewsletterIssue', 'url'=>array('index')),
);
?>

<h1>Create NewsletterIssue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>