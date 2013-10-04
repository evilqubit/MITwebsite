<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'newsletter-history-form',
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size'=>50, 'maxlength'=>100)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <?php if($this->module->displayTemplates): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'templateId'); ?>
            <?php echo $form->dropDownList($model, 'templateId', NewsletterTemplate::listArray()); ?>
            <?php echo $form->error($model, 'templateId'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>

        <?php
        $this->widget('application.extensions.tinymce.ETinyMce', array(
            'model'=>$model,
            'attribute'=>'text',
        ));
        ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>
    <?php if($this->module->enableGroups && $model->scenario == 'send'): ?>
    <div class="row">
        <br />
        <label>Choose Groups:</label>
        <?php 
        $groupsArray = CHtml::listData(NewsletterGroup::model()->active()->findAll(), 'id', 'name');
        $groupsArray[0] = 'Others';
        echo CHTML::ListBox('groups', '', $groupsArray, array('multiple'=>'multiple')); 
        ?>
    </div>
    <?php endif; ?>
    
    <div class="row buttons">
        <br />
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->