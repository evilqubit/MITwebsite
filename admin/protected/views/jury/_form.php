<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jury-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>
 

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->passwordField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div> 
<!--
	
	<div class="row">
		<?php echo $form->labelEx($model,'lastAccess'); ?>
		<?php echo $form->textField($model,'lastAccess'); ?>
		<?php echo $form->error($model,'lastAccess'); ?>
	</div>	-->

	<div class="row">
		<?php echo $form->labelEx($model,'lang'); ?> 
		<?php echo $form->dropDownList($model,'lang', array("en"  =>"English", "ar"  =>"Arabic", "fr"  =>"French" ) ); ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>


	<div class="row" >
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active', array(1=>"Yes", 0=> "No" ) ); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>
 
	<div class="row">
		<?php echo $form->labelEx($model,'ordering'); ?>
		<?php echo $form->textField($model,'ordering'); ?>
		<?php echo $form->error($model,'ordering'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->