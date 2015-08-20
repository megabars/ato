<?php
/* @var $this AdminController */
/* @var $model Faqs */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'faqs-form',
        'enableAjaxValidation' => false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'question'); ?>
            <?php echo $form->textField($model, 'question', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'question'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'answer'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'answer')); ?>
            <?php echo $form->error($model, 'answer'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>