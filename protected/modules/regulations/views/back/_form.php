<?php
/* @var $this EditionItemController */
/* @var $model EditionItem */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'npa-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
//            'afterValidate' => 'js: function(form, data, hasError) {
//                if (!hasError) {
//                    $.ajax({
//                        type: "POST",
//                        url: "/regulations/back/save/id/'.$model->id.'",
//                        data: form.serialize(),
//                        success: function(data) {
//                            $("#npa_dialog").dialog("close");
//                            $.fn.yiiGridView.update("npa-grid");
//                        }
//                    });
//                    return false;
//                }
            )
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'number'); ?>
        <?php echo $form->textField($model, 'number', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->textField($model, 'type', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_real'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'Regulation[date_real]',
            'value' => $model->date_real ? date('Y-m-d H:i', $model->date_real) : '',
            'mode' => 'datetime',
            'options'=>array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_real'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_public'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'Regulation[date_public]',
            'value' => $model->date_public ? date('Y-m-d H:i', $model->date_public) : '',
            'mode' => 'datetime',
            'options'=>array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_public'); ?>
    </div>

    <?php echo $form->error($model, 'date'); ?>

    <?php echo $form->hiddenField($model, 'file', array('value'=>0)); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'pdf'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'pdf',
            'allowedExtensions' => array('pdf'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploaderPdf')
        )); ?>
        </div>
        <?php echo $form->error($model, 'pdf'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'doc'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'doc',
            'allowedExtensions' => array('doc', 'docx'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploaderDoc')
        )); ?>
        </div>
    <?php echo $form->error($model, 'doc'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'zip'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'zip',
            'allowedExtensions' => array('zip', 'rar'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploaderZip')
        )); ?>
        </div>
    <?php echo $form->error($model, 'zip'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'preview'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model' => $model,
            'attribute' => 'preview')); ?>
        <?php echo $form->error($model, 'preview'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
