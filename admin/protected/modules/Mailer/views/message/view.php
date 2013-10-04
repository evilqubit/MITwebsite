<?php
$this->breadcrumbs = array(
    'Mail Messages'=>array('index'),
    $model->title,
);

$this->menu = array(
    array('label'=>'All Mail Messages', 'url'=>array('index')),
    array('label'=>'Update Mail Message', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete Mail Message', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Mail Message #<?php echo $model->id; ?></h1>

<?php
$array = array(
    'id',
    'title',
    'body',
    'isHtml',
    'sendingTime',
    'referenceId',
    'active',
    'deleted',
    'cUserId',
    'cTime',
    'cIpAddress',
);
$array[] = array('label'=>'Total', 'value'=>$model->total);
$array[] = array('label'=>'Success', 'value'=>$model->success.' - '.$model->totalPercentage($model->success).'%');
$array[] = array('label'=>'Pending', 'value'=>$model->pending.' - '.$model->totalPercentage($model->pending).'%');
$array[] = array('label'=>'Failed', 'value'=>$model->failed.' - '.$model->totalPercentage($model->failed).'%');
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>$array,
));
?>

<h3 style="margin:20px 0px 0px 0px;">Emails:</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'mail-queue-grid',
    'dataProvider'=>$mails->search(),
    'filter'=>$mails,
    'columns'=>array(
        'id',
        'to',
        'toName',
        array(
            'name'=>'active',
            'filter'=>array(0=>'Not Acrive', 1=>'Active'),
        ),
        array(
            'name'=>'status',
            'value'=>'$data->statusName',
            'filter'=>MailQueue::statusArray(),
        ),
        MailQueue::activateButton('mail-queue-grid', 'queue'),
        array(
			'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("mailer/queue/view",array("id"=>$data->id))',
            'updateButtonUrl'=>'Yii::app()->createUrl("mailer/queue/update",array("id"=>$data->id))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("mailer/queue/delete",array("id"=>$data->id))',
		),
    ),
));
?>