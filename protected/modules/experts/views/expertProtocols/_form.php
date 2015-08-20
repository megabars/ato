<?php
/* @var $this ExpertProtocolsController */
/* @var $model ExpertProtocols */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'expert-protocols-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
        ),
    )); ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'date',
            'options' => array(
                'dateFormat' => 'dd.mm.yy',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'file_id'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'file_id',
            'isImage' => false,
            'allowedExtensions' => array(
                'jpg', 'jpeg', 'gif', 'png', 'bmp', 'jpe', 'tif', 'tiff', 'txt',
                'rtf', 'doc', 'docx', 'pdf', 'djvu', 'htm', 'html', 'xls', 'xlsx',
                'ods', 'xml', 'dbf', 'txt', 'rtf', 'odt', 'sxw', 'ppt', 'pptx',
                '7z', 'rar', 'zip', 'tar', 'csv'),
        )); ?>
        <?php echo $form->error($model, 'file_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'expertsHelperIds'); ?><br/>
        <?php echo $form->checkBoxList($model, 'expertsHelperIds', CHtml::listData(ExpertsHelper::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'expertsHelperIds'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'descr'); ?>
        <?php echo $form->textArea($model, 'descr'); ?>
        <?php echo $form->error($model, 'descr'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->textField($model, 'type', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'number'); ?>
        <?php echo $form->textField($model, 'number', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'number'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->