<?php
$this->breadcrumbs=array(
	'Newsletter'=>array('index'),
	$model->id,
);
$visible = (TimeHelper::zeroDate($model->sendingTime));
$this->menu = array(
    array('label'=>'All Newsletters', 'url'=>array('index')),
    array('label'=>'Manage Subscribers', 'url'=>array('subscriber/index')),
     
    array('label'=>'Activate', 'url'=>array('admin/activateMail/id/'.$model->id) , 'visible'=>(!$visible && !$mailMessage->active)),
    array('label'=>'Deactivate', 'url'=>array('admin/stopMail/id/'.$model->id) , 'visible'=>(!$visible && $mailMessage->active)),
     
    array('label'=>'Update Newsletter', 'url'=>array('update', 'id'=>$model->id), 'visible'=>$visible),
    array('label'=>'Send Newsletter Now', 'url'=>array('schedule', 'id'=>$model->id), 'visible'=>$visible),
);
?>
<h2>Newsletter #<?php echo $model->id; ?>:</h2>

<?php 
$array = array(
    'id',
    'title',
    'text',
);
if($this->module->displayTemplates){
    $value = "-";
    if($model->template){
        $value = $model->template->name;
    }
    $array[] = array('name'=>'templateId', 'value'=>$value);
}
$array[] = 'sendingTime';
if($this->module->enableGroups){
    $array[] = array('name'=>'Groups', 'value'=>$model->groupsNames());
}
if($this->module->usingMailEngine){
    $array[] = array('label'=>'Total', 'value'=>$model->total);
    $array[] = array('label'=>'Success', 'value'=>$model->success.' - '.$model->totalPercentage($model->success).'%');
    $array[] = array('label'=>'Pending', 'value'=>$model->pending.' - '.$model->totalPercentage($model->pending).'%');
    $array[] = array('label'=>'Failed', 'value'=>$model->failed.' - '.$model->totalPercentage($model->failed).'%');
}
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>$array,
));
?>
<?php if($this->module->usingMailEngine): ?>
    <h3 style="margin:20px 0px 0px 0px;">Emails:</h3>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'mail-queue-grid',
        'dataProvider'=>$mails->searchByReferenceId($model->id),
        'filter'=>$mails,
        'columns'=>array(
            'id',
            'to',
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
        ),
    ));
    ?>
<?php endif; ?>