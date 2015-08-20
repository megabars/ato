<?php
/* @var $this RecordController */
/* @var $model Record */
/* @var $form CActiveForm */
?>
<?php if($model->type_id == RecordType::EVENT): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'external_link'); ?>
        <?php echo $form->textField($model, 'external_link', array('size' => 60, 'maxlength' => 500)); ?>
        <?php echo $form->error($model, 'external_link'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <?php echo $form->labelEx($model, 'description'); ?>
    <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
    <?php echo $form->error($model, 'description'); ?>
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
    </div>
    <?php echo $form->error($model, 'file_id'); ?>
</div>

<?php if($model->type_id == RecordType::REGION): ?>
<div class="row">
    <?php echo $form->labelEx($model, 'map_id'); ?>
    <?php echo $form->dropDownList($model, 'map_id', CHtml::listData(Maps::model()->findAll(), 'id', 'name')); ?>
    <?php echo $form->error($model, 'map_id'); ?>
</div>
<?php endif; ?>