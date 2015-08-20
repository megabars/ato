<?php
/* @var $this AdminController */
/* @var $model OpendataVersion */
/* @var $form CActiveForm */
?>

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

        <div class="row">
            <?php echo $form->labelEx($model, 'structure_file'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'structure_file', 'isImage' => false, 'config' => array('allowedExtensions' => array('csv')))); ?>
            <?php echo $form->error($model, 'structure_file'); ?>
        </div>

        <div class="row" style="display: none;">
            <?php echo $form->labelEx($model, 'opendata_id'); ?>
            <?php echo $form->dropDownList($model, 'opendata_id', CHtml::listData(Opendata::model()->findAll(), 'id', 'title')); ?>
            <?php echo $form->error($model, 'opendata_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'date'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'OpendataVersion[date]',
                'value' => $model->date ? date('Y-m-d H:i', $model->date) : date('Y-m-d H:i'),
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

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>