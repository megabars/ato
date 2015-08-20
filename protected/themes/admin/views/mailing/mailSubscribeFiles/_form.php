<?php
/* @var $this MailSubscribeFilesController */
/* @var $model MailSubscribeFiles */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mail-subscribe-files-form',
	'enableAjaxValidation'=>false,
)); ?>


    <?php echo $form->errorSummary($model); ?>


            <div class="row">
            <?php echo $form->labelEx($model,'photo'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
            <?php echo $form->error($model,'photo'); ?>
        </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->