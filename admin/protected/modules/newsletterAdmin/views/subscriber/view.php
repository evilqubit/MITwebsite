<?php
$this->breadcrumbs=array(
	'Newsletter Subscribers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Subscribers', 'url'=>array('index')),
    array('label'=>'Manage Newsletters', 'url'=>array('admin/index')),
);
if($this->module->backendAddSubscriber) $this->menu[] = array('label'=>'Add Subscriber', 'url'=>array('create'));
if($this->module->backendUpdateSubscriber) $this->menu[] = array('label'=>'Update Subscriber', 'url'=>array('update', 'id'=>$model->id));
if($this->module->backendDeleteSubscriber) $this->menu[] = array('label'=>'Delete Subscriber', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'));
?>

<h1>View Newsletter Subscriber #<?php echo $model->id; ?></h1>

<?php 
$attributes = array(
		'id',
		'email',
		'firstName',
        array(
            'name'=>'Groups',
            'value'=>$model->groupsNames(),
            'visible'=>$this->module->enableGroups,
        ),
		'unsubscribed',
        array(
            'name'=>'source',
            'value'=>$model->sourceDescription,
        ),
		'unsubscriptionDate',
		'active',
		'cTime',
	);
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attributes,
)); ?>
