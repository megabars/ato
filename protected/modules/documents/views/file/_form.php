<?php
/* @var $this EditionItemController */
/* @var $model EditionItem */
/* @var $form CActiveForm */
?>

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
                        url: "/documents/file/save/id/'.$model->id.'",
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

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'executive_id'); ?>
        <?php echo $form->dropDownList($model, 'executive_id', array('0'=>'Администрация Томской области') + CHtml::listData(Executive::model()->sorted()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'executive_id'); ?>
    </div>

    <?php if(!empty($groupId)): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'folder_id'); ?>
            <?php echo $form->dropDownList($model, 'folder_id', CHtml::listData(DocumentsFolder::model()->findAllByAttributes(array('group_id' => $groupId)), 'id', 'title')); ?>
            <?php echo $form->error($model, 'folder_id'); ?>
        </div>
    <?php else: ?>
        <?php echo $form->hiddenField($model, 'folder_id', array('value'=>$folderId)); ?>
    <?php endif ?>

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

    <div class="row">
        <?php echo $form->labelEx($model, 'preview'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'preview')); ?>
        <?php echo $form->error($model, 'preview'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
    </div>

<?php $this->endWidget(); ?>
