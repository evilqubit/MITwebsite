<?php
$this->menu = array(
    array('label'=>'All Newsletters', 'url'=>array('index')),
    array('label'=>'Manage Subscribers', 'url'=>array('subscriber/index')),
    array('label'=>'Send Later', 'url'=>array('detail', 'id'=>$model->id)),
);
?>
<h2>Send Newsletter 2</h2>

<h3>Preview:</h3>

<div style="width:500px; overflow-x: scroll; border: dashed 1px grey; padding: 6px;">
    <?php echo $model->bodyWithTemplate(); ?>
</div>

<!-- End Preview -->
<br /><br />
<hr />

<h3>Send testing email:</h3>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'test-newsletter-form',
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
            ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($testNewsletterModel, 'email'); ?>
        <?php echo $form->textField($testNewsletterModel, 'email', array('size'=>30)); ?>
        <?php echo $form->error($testNewsletterModel, 'email'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>

<!-- End Send test email -->

<br />
<hr />

<div>
    <?php
    if($this->module->schedule): //if schedule is enabled
        $this->publishDateTimePickerAssets();
        $clientScript = Yii::app()->clientScript;
        $clientScript->registerScript('time-picker', "
$('#dateTime').datetimepicker();
");
        ?>

        <h3>Schedule Newsletter:</h3>
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id'=>'schedule-form',
                'enableClientValidation'=>false,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                    ));
            ?>

            <div class="row">
                <?php echo $form->labelEx($scheduleModel, 'time'); ?>
                <?php echo $form->textField($scheduleModel, 'time', array('id'=>'dateTime')); ?>
                <?php echo $form->error($scheduleModel, 'time'); ?>
            </div>

            <?php echo $form->hiddenField($scheduleModel, 'id', array('value'=>$model->id)); ?>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Submit'); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
        <hr />
    <?php endif; ?>

    <h3>Send Newsletter Now:</h3>

    <form action="" method="POST">
        <?php echo CHtml::hiddenField('sendNow', 'true'); ?>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Send Now'); ?>
        </div>
    </form>

</div>



