<?php
/* @var $this AdminController */
/* @var $model Links */
/* @var $linksForm CActiveForm */
?>
    <?php

    if ($model->isNewRecord)
        $url = '/links/back/save';
    else
        $url = '/links/back/save/id/'.$model->id;


    $linksForm = $this->beginWidget('CActiveForm', array(
        'id' => 'links-form',
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
                            $("#links_dialog").dialog("close");
                            form[0].reset();
                            $.fn.yiiGridView.update("links-grid");
                            if(data)
                                $("#links_count").text("("+data+")");
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <div class="row">
        <?php echo $linksForm->labelEx($model, 'title'); ?>
        <?php echo $linksForm->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $linksForm->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $linksForm->labelEx($model, 'url'); ?>
        <?php echo $linksForm->textField($model, 'url', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $linksForm->error($model, 'url'); ?>
    </div>

    <div class="row">
        <?php //echo $linksForm->labelEx($model, 'photo'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
        <?php echo $linksForm->error($model, 'photo'); ?>
    </div>

    <?php echo $linksForm->hiddenField($model, 'group_id');?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

