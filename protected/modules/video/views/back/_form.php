<?php
/* @var $this AdminController */
/* @var $model Video */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        'enableAjaxValidation' => false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'date'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'Video[date]',
                'value' => date('Y-m-d H:i', $model->date ? strtotime($model->date) : time()),
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'date'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'photo'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
            <?php echo $form->error($model, 'photo'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'link'); ?>
            <?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'link'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'mp4'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'mp4', 'config' => array('allowedExtensions' => array('mp4', 'avi', 'wmv', 'mpeg', 'mpg', 'flv', 'mov')))); ?>
            <?php echo $form->error($model, 'mp4'); ?>
        </div>

        <div class="row checkbox-list">
            <?php echo $form->checkBox($model, 'state'); ?>
            <?php echo $form->labelEx($model, 'state'); ?>
            <?php echo $form->error($model, 'state'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>