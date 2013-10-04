<?php
$this->breadcrumbs=array(
    'Newsletter'=>array('admin/index'),
	'Subscribers'=>array('index'),
	'Manage',
);

$this->menu=array(
    array('label'=>'Manage Newsletters', 'url'=>array('admin/index')),
);
if($this->module->backendAddSubscriber){
    $this->menu[] = array('label'=>'Add Subscriber', 'url'=>array('create'));
}
/*
if($this->module->backendImportSubscriber){
    $this->menu[] = array('label'=>'Import Subscribers', 'url'=>array('import'));
}
if($this->module->backendExportSubscriber){
    $this->menu[] = array('label'=>'Export Subscribers', 'url'=>array('export'));
}
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('newsletter-subscriber-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Newsletter Subscribers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$buttons = '{view}';
if($this->module->backendUpdateSubscriber) $buttons .= '{update}';
if($this->module->backendDeleteSubscriber) $buttons .= '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'newsletter-subscriber-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'email',
		'firstName',
		array(
            'name'=>'unsubscribed',
            'filter'=>array(0=>'Subscribed', 1=>'Unsubscribed'),
        ),
        array(
            'name'=>'active',
            'filter'=>array(0=>'Not Acrive', 1=>'Active'),
        ),
        'cTime',
        NewsletterSubscriber::activateButton('newsletter-subscriber-grid'),
		array(
			'class'=>'CButtonColumn',
            'template'=>$buttons,
		),
	),
)); ?>
