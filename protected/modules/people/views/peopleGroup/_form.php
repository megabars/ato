<?php
/* @var $this PeopleGroupController */
/* @var $model PeopleGroup */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'people-group-form',
	'enableAjaxValidation'=>false,
)); ?>


    <?php echo $form->errorSummary($model); ?>

            <div class="row">
            <?php echo $form->labelEx($model,'group_id'); ?>
            <?php echo $form->dropDownList($model,'group_id',PeopleGroup::$labels); ?>
            <?php echo $form->error($model,'group_id'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title'); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>

<!--    <div class="row">-->
<!--        --><?php //echo $form->labelEx($model,'sort'); ?>
<!--        --><?php //echo $form->textField($model,'sort'); ?>
<!--        --><?php //echo $form->error($model,'sort'); ?>
<!--    </div>-->

        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->