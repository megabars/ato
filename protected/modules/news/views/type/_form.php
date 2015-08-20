<?php
/* @var $this AdminController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-type-form',
        'enableAjaxValidation' => false,
    )); ?>

        <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'alias'); ?>
            <?php echo $form->textField($model, 'alias', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'alias'); ?>
        </div>
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