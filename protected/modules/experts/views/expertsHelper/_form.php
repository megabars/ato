<?php
/* @var $this ExpertsHelperControllerController */
/* @var $model ExpertsHelper */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'experts-helper-form',
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textArea($model,'name',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'state', array('style' => 'display: inline;')); ?>
            &nbsp;
            <?php echo $form->checkBox($model, 'state'); ?>
            <?php echo $form->error($model, 'state'); ?>
        </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->