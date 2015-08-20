<?php
/* @var $this ContestController */
/* @var $model Contest */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'contest-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Поля, отмеченные <span class="required">*</span> обязательны для заполения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'name' => 'RatingDoc[date]',
            'value' => date('Y-m-d', $model->date ? $model->date : time()),
            'options'=>array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>500)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row" id="file-input">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php $this->widget('FileUpload', array(
            'isImage' => false,
            'model' => $model,
            'id' => "RatingDoc_file",
            'attribute' => 'file',
            'config' => array('allowedExtensions' => array('pdf', 'doc', 'docx', 'zip', 'rar')))); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->