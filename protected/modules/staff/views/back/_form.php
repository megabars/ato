<?php
/* @var $this AdminController */
/* @var $model Staff */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        'enableAjaxValidation' => false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'file'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'file', 'isImage' => false, 'config' => array('allowedExtensions' => array('xls')))); ?>
            <?php echo $form->error($model, 'file'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'result_file'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'result_file', 'isImage' => false, 'config' => array('allowedExtensions' => array('pdf', 'rtf', 'doc', 'docx', 'txt', 'png', 'jpg', 'jpeg')))); ?>
            <?php echo $form->error($model, 'result_file'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'result'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'result')); ?>
            <?php echo $form->error($model, 'result'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'state'); ?>
            <?php echo $form->dropDownList($model, 'state', CHtml::listData(StaffState::model()->findAll(), 'id', 'title')); ?>
            <?php echo $form->error($model, 'state'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>