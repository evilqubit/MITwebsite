<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mail-message-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isHtml'); ?>
		<?php echo $form->textField($model,'isHtml'); ?>
		<?php echo $form->error($model,'isHtml'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sendingTime'); ?>
		<?php echo $form->textField($model,'sendingTime'); ?>
		<?php echo $form->error($model,'sendingTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'referenceId'); ?>
		<?php echo $form->textField($model,'referenceId'); ?>
		<?php echo $form->error($model,'referenceId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->