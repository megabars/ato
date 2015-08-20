<?php
/* @var $this AdminController */
/* @var $model News */
/* @var $newsForm CActiveForm */
?>
<?php

if ($model->isNewRecord)
    $url = '/pages/pageNews/save';
else
    $url = '/pages/pageNews/save/id/'.$model->id;


$newsForm = $this->beginWidget('CActiveForm', array(
    'id' => 'news-form',
    'enableAjaxValidation' => false,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "'.$url.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#news_dialog").dialog("close");
                            form[0].reset();
                            $.fn.yiiGridView.update("news-grid");
                            if(data)
                                $("#news_count").text("("+data+")");
                        }
                    });
                    return false;
                }
            }')
)); ?>

<p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

<?php echo $newsForm->errorSummary($model); ?>

<div class="row">
    <?php echo $newsForm->labelEx($model, 'title'); ?>
    <?php echo $newsForm->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
    <?php echo $newsForm->error($model, 'title'); ?>
</div>

<div class="row">
    <?php echo $newsForm->labelEx($model, 'photo'); ?>
    <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
    <?php echo $newsForm->error($model, 'photo'); ?>
</div>

<div class="row">
    <?php echo $newsForm->labelEx($model, 'photo_title'); ?>
    <?php echo $newsForm->textField($model, 'photo_title', array('size' => 60, 'maxlength' => 255)); ?>
    <?php echo $newsForm->error($model, 'photo_title'); ?>
</div>

<div class="row">
    <?php echo $newsForm->labelEx($model, 'preview'); ?>
    <?php echo $newsForm->textArea($model, 'preview', array('rows' => 6, 'cols' => 50)); ?>
    <?php echo $newsForm->error($model, 'preview'); ?>
</div>

<div class="row">
    <?php echo $newsForm->labelEx($model, 'description'); ?>
    <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
    <?php echo $newsForm->error($model, 'description'); ?>
</div>

<div class="row">
    <?php echo $newsForm->labelEx($model, 'state'); ?>

    <div class="radio-list">
        <?php echo $newsForm->radioButtonList($model,'state', StatusType::instance()->list); ?>

        <div class="timepicker">
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'date',
                'value' => 0,
                'options'=>array(
                    'dateFormat' => 'dd.mm.yy',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
        </div>
    </div>
    <?php echo $newsForm->error($model, 'date'); ?>
    <?php echo $newsForm->error($model, 'state'); ?>
</div>

<?php echo $newsForm->hiddenField($model, 'type');?>

<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
</div>

<?php $this->endWidget(); ?>
