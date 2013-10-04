<?php
$this->breadcrumbs=array(
    'Newsletter'=>array('admin/index'),
	'Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Newsletter Groups', 'url'=>array('index')),
	array('label'=>'Create Newsletter Group', 'url'=>array('create')),
	array('label'=>'View Newsletter Group', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Newsletter Group <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>