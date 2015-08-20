<?php
/* @var $this MenuController */
/* @var $model NavMenu */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'nav-menu-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'alias'); ?>
        <?php echo $form->dropDownList($model, 'alias', NavMenu::$aliases); ?>
        <?php echo $form->error($model, 'alias'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($model, 'published'); ?>
        <?php echo $form->labelEx($model, 'published', array('style' => 'display: inline;')); ?>
        <?php echo $form->error($model, 'published'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fileId'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'fileId', 'allowedExtensions' => array('csv'), 'isImage' => false)); ?>
        <?php echo $form->error($model, 'fileId'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->