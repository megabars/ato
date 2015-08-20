<?php
/* @var $this AfishaConfController */
/* @var $model AfishaConf */

$this->breadcrumbs=array(
	'Календарь мероприятий'=>array('/afisha/back'),
	'Настройки календаря мероприятий',
);
$extensions = array('pdf', 'jpg', 'doc', 'docx', 'xls', 'xlsx', 'csv' );

?>

<h1>Настройки календаря мероприятий</h1>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'afisha-conf-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'month_file'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'month_file', 'config' => array('allowedExtensions' => $extensions), 'isImage' => false)); ?>
        <?php echo $form->error($model, 'month_file'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'quarter_file'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'quarter_file', 'config' => array('allowedExtensions' => $extensions), 'isImage' => false)); ?>
        <?php echo $form->error($model, 'quarter_file'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'year_file'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'year_file', 'config' => array('allowedExtensions' => $extensions), 'isImage' => false)); ?>
        <?php echo $form->error($model, 'year_file'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->