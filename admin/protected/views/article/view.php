<?php
$this->breadcrumbs=array(
	'Pages'=>array('/pages'),
	'Articles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Article #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'link',
		 array(
                  'name'=>'img',
                    'type'=>'html',
                    'value'=>'<a href="../images/articles/'.$model->img.'" target="_blank"><img src="../images/articles/thumbs/'.$model->img.'" ></a>',
		 
                ),
		'active',
		'ordering',
		'cTime',
		'cIpAddress',
		'cUserId',
	),
)); ?>
