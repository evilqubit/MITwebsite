<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'questions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'qtitle_en'); ?>
		<?php //echo $form->textArea($model,'qtitle_en',array('rows'=>6, 'cols'=>50)); ?>
     <?php
     	$this->widget('application.extensions.cleditor.ECLEditor', array(
        'model'=>$model,
        'attribute'=>'qtitle_en'
    	));
   		?>
		<?php echo $form->error($model,'qtitle_en'); ?>
	</div>
	 
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'qtitle_ar'); ?> 
     <?php
     	$this->widget('application.extensions.cleditor.ECLEditor', array(
        'model'=>$model,
        'attribute'=>'qtitle_ar'
    	));
   		?>
		<?php echo $form->error($model,'qtitle_ar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qtitle_fr'); ?>
     <?php
     	$this->widget('application.extensions.cleditor.ECLEditor', array(
        'model'=>$model,
        'attribute'=>'qtitle_fr'
    	));
   		?>
		<?php // echo $form->textArea($model,'qtitle_fr',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'qtitle_fr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'types_idtypes'); ?>
		<?php //echo $form->textField($model,'types_idtypes'); ?>
		
		<?php echo $form->dropDownList($model,'types_idtypes',   CHtml::listData(Types::model()->findAll(), 'idtypes', 'display') ); ?>
		<?php echo $form->error($model,'types_idtypes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grade'); ?>
		<?php echo $form->textField($model,'grade'); ?>
		<?php echo $form->error($model,'grade'); ?>
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