<?php
$this->breadcrumbs=array(
	'Juries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jury', 'url'=>array('index')),
);
?>

<h1>Create Jury</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>