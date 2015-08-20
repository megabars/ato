<?php
/* @var $this AdminController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'contact-form',
        'enableAjaxValidation' => false,
    )); ?>

        <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'executive_id'); ?>
            <?php echo $form->dropDownList($model, 'executive_id', CHtml::listData(Executive::model()->findAll(array('order' => 'name')), 'id', 'name')); ?>
            <?php echo $form->error($model, 'executive_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'alias'); ?>
            <?php echo $form->dropDownList($model, 'alias', array('footer' => 'Основная контактная информация')); ?>
            <?php echo $form->error($model, 'alias'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'photo'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
            <?php echo $form->error($model, 'photo'); ?>
        </div></div>

        <div class="row">
            <?php echo $form->labelEx($model, 'address'); ?>
            <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 500)); ?>
            <?php echo $form->error($model, 'address'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>