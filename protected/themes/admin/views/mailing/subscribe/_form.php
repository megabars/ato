<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscribe-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <div class="row">
            <?php echo $form->labelEx($model,'id'); ?>
            <?php echo $form->textField($model,'id'); ?>
            <?php echo $form->error($model,'id'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'first_name'); ?>
            <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'first_name'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'last_name'); ?>
            <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'last_name'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'group'); ?>
            <?php echo $form->textField($model,'group'); ?>
            <?php echo $form->error($model,'group'); ?>
        </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->