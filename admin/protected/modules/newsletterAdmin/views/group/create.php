<?php
$this->breadcrumbs=array(
    'Newsletter'=>array('admin/index'),
	'Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Newsletter Groups', 'url'=>array('index')),
);
?>

<h1>Create Newsletter Group</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>