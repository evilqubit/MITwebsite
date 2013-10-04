<?php
$this->breadcrumbs=array(
    'Newsletter'
);
$this->menu=array(
	array('label'=>'Send Newsletter', 'url'=>array('send')),
    array('label'=>'Manage Subscribers', 'url'=>array('subscriber/index')),
);
if($this->module->enableGroups){
    $this->menu[] = array('label'=>'Manage Groups', 'url'=>array('group/index'));
}
?>
<h2 style="margin:18px 0px 0px 0px;">Newsletter History:</h2>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'history-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
        array(
            'name'=>'text',
            'value'=>'wordwrap(TextHelper::limit_words($data->text,20), 20, "\n", true)',
        ),
		'sendingTime',
        array(
			'class'=>'CButtonColumn',
            'template'=>'{view}',
            'viewButtonUrl'=>'Yii::app()->createUrl("newsletterAdmin/admin/detail",array("id"=>$data->id))',
		),
	),
)); ?>