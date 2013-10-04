<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'newsletter-subscriber-form',
        'enableAjaxValidation'=>false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
<?php echo $form->textField($model, 'email', array('size'=>50, 'maxlength'=>50)); ?>
<?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'firstName'); ?>
<?php echo $form->textField($model, 'firstName', array('size'=>50, 'maxlength'=>50)); ?>
<?php echo $form->error($model, 'firstName'); ?>
    </div><!--

    <div class="row">
        <?php echo $form->labelEx($model, 'lastName'); ?>
<?php echo $form->textField($model, 'lastName', array('size'=>50, 'maxlength'=>50)); ?>
<?php echo $form->error($model, 'lastName'); ?>
    </div>

    --><div class="row">
        <?php echo $form->labelEx($model, 'active'); ?>
<?php echo $form->checkBox($model, 'active'); ?>
    <?php echo $form->error($model, 'active'); ?>
    </div>

    <?php
    if($this->module->enableGroups):
        echo $form->ListBox($model, 'groups', CHtml::listData(NewsletterGroup::model()->active()->findAll(), 'id', 'name'), array('multiple'=>'multiple'));
    endif;
    ?>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->