<?php
/* @var $this AdminController */
/* @var $model News */

$this->breadcrumbs = array(
    'Губернатор' => '/gubernator/back/index',
    'Информация о губернаторе',
);
?>

<div class="page-header">
    <h2>Информация о губернаторе</h2>
</div>

<div class="list-group"></div>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'guber-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'fio'); ?>
        <?php echo $form->textField($model, 'fio', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'fio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'photo'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
        <?php echo $form->error($model, 'photo'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>