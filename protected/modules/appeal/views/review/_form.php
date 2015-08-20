<?php
/* @var $this ReviewController */
/* @var $model AppealReview */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'review-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/appeal/review/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#review_dialog").dialog("close");
                            $.fn.yiiGridView.update("review-grid");
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'year'); ?>
        <?php echo $form->textField($model, 'year', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'year'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'file_id'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'file_id',
            'allowedExtensions' => array(
                'jpg', 'jpeg', 'gif', 'png', 'bmp', 'jpe', 'tif', 'tiff', 'txt',
                'rtf', 'doc', 'docx', 'pdf', 'djvu', 'htm', 'html', 'xls', 'xlsx',
                'ods', 'xml', 'dbf', 'txt', 'rtf', 'odt', 'sxw', 'ppt', 'pptx',
                '7z', 'rar', 'zip', 'tar'),
        'isImage' => false)); ?>
        <?php echo $form->error($model, 'file_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model'=>$model,
            'attribute'=>'description',
        )); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

<?php $this->endWidget(); ?>
</div>