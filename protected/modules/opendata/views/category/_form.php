<?php
/* @var $this AdminController */
/* @var $model Opendata */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'opendata-form',
        'enableAjaxValidation' => false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>