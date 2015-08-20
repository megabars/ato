<?php
/* @var $this AdminController */
/* @var $model OpendataSettings */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'Открытые данные' => '/opendata/back/index',
    'Обновление реестра набора данных',
);
?>

<div class="page-header">
    <h2>Обновление реестра набора данных</h2>
</div>


<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'opendata-form',
        'enableAjaxValidation' => false,
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'file', 'isImage' => false, 'config' => array('allowedExtensions' => array('csv')))); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>