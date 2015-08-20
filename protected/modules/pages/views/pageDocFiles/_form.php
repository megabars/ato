<?php
/* @var $this EditionItemController */
/* @var $model EditionItem */
/* @var $form CActiveForm */
?>

<?php
if ($model->isNewRecord)
    $url = $this->createUrl('/documents/file/save');
else
    $url = $this->createUrl('/documents/file/save', array('id' => $model->id));


$form = $this->beginWidget('CActiveForm', array(
    'id' => 'document-form',
    'enableAjaxValidation' => false,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'afterValidate' => 'js: function(form, data, hasError) {
            console.log(1, form, data, hasError);
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "'.$url.'",
                        data: form.serialize(),
                        success: function() {
                            $("#file_dialog").dialog("close");
                            form[0].reset();
                            $.fn.yiiGridView.update("folders-grid");
                        }
                    });
                    return false;
                }
            }')
));


?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model, 'title'); ?>
    <?php echo $form->textField($model, 'title', array('size' => 60)); ?>
    <?php echo $form->error($model, 'title'); ?>
</div>

<?php if(!empty($groupId)): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'folder_id'); ?>
        <?php echo $form->dropDownList($model, 'folder_id', CHtml::listData(DocumentsFolder::model()->findAllByAttributes(array('group_id' => $groupId)), 'id', 'title')); ?>
        <?php echo $form->error($model, 'folder_id'); ?>
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


<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
</div>

<?php $this->endWidget(); ?>
