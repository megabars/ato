<?php
/* @var $this PublicController */
/* @var $model AcPublic */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'public-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/antiCorruption/public/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#public_dialog").dialog("close");
                            $.fn.yiiGridView.update("public-grid");
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'fio'); ?>
        <?php echo $form->textField($model, 'fio'); ?>
        <?php echo $form->error($model,'fio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'post_type_id'); ?>
        <?php echo $form->dropDownList($model, 'post_type_id', CHtml::listData(CategoryPost::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model,'post_type_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'post'); ?>
        <?php echo $form->textField($model, 'post'); ?>
        <?php echo $form->error($model,'post'); ?>
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
                '7z', 'rar', 'zip', 'tar'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploader')
        )); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'year'); ?>
        <?php echo $form->textField($model, 'year'); ?>
        <?php echo $form->error($model,'year'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model, 'type', array(1=>"Доход", 2=>'Расход')); ?>
        <?php echo $form->error($model,'type'); ?>
	</div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->