<?php
$this->breadcrumbs=array(
    'Newsletter'=>array('admin/index'),
	'Subscribers'=>array('index'),
	'Import',
);
?>

<h2>Import Subscribers</h2>
<div class="form">

    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'import-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
<?php echo $form->fileField($model, 'file'); ?>
<?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton('Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->