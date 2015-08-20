<?php
/* @var $this FileController */
/* @var $model IeFile */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'file-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/independentEvaluation/file/save/id/'.$model->id.'/type/'.$model->file_type.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#file_dialog").dialog("close");
                            $.fn.yiiGridView.update("file-grid");
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model, 'file_type'); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <?php if($model->file_type == DocumentType::RECOMMENDATION || $model->file_type == DocumentType::SUPPORT): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model'=>$model,
            'attribute'=>'description',
        )); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'file',
            'allowedExtensions' => array(
                'jpg', 'jpeg', 'gif', 'png', 'bmp', 'jpe', 'tif', 'tiff', 'txt',
                'rtf', 'doc', 'docx', 'pdf', 'djvu', 'htm', 'html', 'xls', 'xlsx',
                'ods', 'xml', 'dbf', 'txt', 'rtf', 'odt', 'sxw', 'ppt', 'pptx',
                '7z', 'rar', 'zip', 'tar'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploader')
        )); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <?php if($model->file_type == DocumentType::REASON): ?>
    <div class="row">
        <?php echo $form->labelEx($model,'doc_type'); ?>
        <?php echo $form->dropDownList($model, 'doc_type', CHtml::listData(CategoryDoc::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model,'doc_type'); ?>
    </div>
    <?php endif; ?>

    <?php if($model->file_type == DocumentType::SUPPORT || $model->file_type == DocumentType::RESULT): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'IeFile[date]',
            'value' => $model->date,
            'mode' => 'datetime',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'dd-mm-yy',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->