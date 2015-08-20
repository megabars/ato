<?php
/* @var $this AdminController */
/* @var $model Forms */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        'enableAjaxValidation' => false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'service'); ?>
            <?php echo $form->textField($model, 'service', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'service'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'file'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'file', 'isImage' => false, 'config' => array('allowedExtensions' => array('doc', 'docx', 'pdf', 'rtf', 'txt', 'xls', 'xlsx')))); ?>
            <?php echo $form->error($model, 'file'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>