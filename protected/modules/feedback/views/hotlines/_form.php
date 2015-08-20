<?php
/* @var $this AdminController */
/* @var $model Staff */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'hotlines-form',
        'enableAjaxValidation' => false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'phone'); ?>
            <?php echo $form->textField($model, 'phone'); ?>
            <?php echo $form->error($model, 'phone'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>