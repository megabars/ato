<?php
/* @var $this ExpertiseController */
/* @var $model AcExpertise */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'expertise-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/antiCorruption/expertise/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#expertise_dialog").dialog("close");
                            $.fn.yiiGridView.update("expertise-grid");
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'executive_id'); ?>
        <?php echo $form->dropDownList($model, 'executive_id', array('0'=>'Администрация Томской области') + CHtml::listData(Executive::model()->findAll(), 'id', 'name')); ?>
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
                '7z', 'rar', 'zip', 'tar'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploader')
        )); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'date_start'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'AcExpertise[date_start]',
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
            'name' => 'AcExpertise[date_finish]',
            'value' => $model->date_finish ? date('d-m-Y H:i', $model->date_finish) : date('d-m-Y H:i'),
            'mode' => 'datetime',
            'options'=>array(
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
            'name' => 'AcExpertise[date_publish]',
            'value' => $model->date_publish ? date('d-m-Y H:i', $model->date_publish) : date('d-m-Y H:i'),
            'mode' => 'datetime',
            'options'=>array(
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

</div><!-- form -->