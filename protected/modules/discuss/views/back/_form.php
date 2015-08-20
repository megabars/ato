<?php
/* @var $this AdminController
 * @var $model Discuss
 * @var $form CActiveForm
 */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'discuss-form',
        'enableAjaxValidation' => false,
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'executive_id'); ?>
        <?php echo $form->dropDownList($model, 'executive_id', array('0' => 'Администрация Томской области') + CHtml::listData(Executive::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'executive_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'file',
            'allowedExtensions' => array(
                'jpg', 'jpeg', 'gif', 'png', 'bmp', 'jpe', 'tif', 'tiff', 'txt',
                'rtf', 'doc', 'docx', 'pdf', 'djvu', 'htm', 'html', 'xls', 'xlsx',
                'ods', 'xml', 'dbf', 'txt', 'rtf', 'odt', 'sxw', 'ppt', 'pptx',
                '7z', 'rar', 'zip', 'tar', 'csv'))); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_start'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'Discuss[date_start]',
            'value' => $model->date_start ? date('d-m-Y H:i', $model->date_start) : date('d-m-Y H:i'),
            'mode' => 'datetime',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_start'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_finish'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'Discuss[date_finish]',
            'value' => $model->date_finish ? date('d-m-Y H:i', $model->date_finish) : date('d-m-Y H:i'),
            'mode' => 'datetime',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_finish'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_publish'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'Discuss[date_publish]',
            'value' => $model->date_publish ? date('d-m-Y H:i', $model->date_publish) : date('d-m-Y H:i'),
            'mode' => 'datetime',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_publish'); ?>
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