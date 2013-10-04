<?php
$this->breadcrumbs = array(
    'Newsletter'=>array('admin/index'),
    'Groups'=>array('index'),
    $model->name,
);

$this->menu = array(
    array('label'=>'List Newsletter Groups', 'url'=>array('index')),
    array('label'=>'Create Newsletter Group', 'url'=>array('create')),
    array('label'=>'Update Newsletter Group', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete Newsletter Group', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Add Multiple Subscribers', 'url'=>array('addMultiple', 'id'=>$model->id)),
    array('label'=>'Remove Multiple Subscribers', 'url'=>array('removeMultiple', 'id'=>$model->id)),
);
?>

<h1>View Newsletter Group #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'name',
        'active',
        'cTime',
        'cIpAddress',
    ),
));
?>
<br /><br />
<h2 style="margin-bottom: 0px;">Subscribers</h2>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'newsletter-subscriber-group-grid',
    'dataProvider'=>$subscribers->search(),
    'columns'=>array(
        'id',
        'groupId',
        'subscriberId',
        array(
            'name'=>'subscriberId',
            'value'=>'$data->subscriber->email',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'deleteButtonUrl'=>'Yii::app()->createUrl("newsletterAdmin/group/deleteSubscriber", array("id"=>"$data->id"))',
        ),
    ),
));
?>
