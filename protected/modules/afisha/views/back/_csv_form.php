<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'csv-form',
        'enableAjaxValidation' => false,
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'fileId'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'fileId', 'allowedExtensions' => array('csv'), 'isImage' => false)); ?></div>
        <div class="errorMessage"></div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::ajaxSubmitButton('Применить', $this->createUrl('/afisha/back/index'), array(
            'dataType'=>'json',
            'beforeSend'=>'js:function(data){
                $("#csv-form").addClass("loader");
            }',
            'success'=>'js:function(data) {
                $("#csv-form").removeClass("loader");
                if(data.success) {
                    $(".errorMessage").text("");
                    $("#csv_dialog").dialog("close");
                    $.fn.yiiGridView.update("events");
                } else {
                    $(".errorMessage").text(data.error);
                }
            }'
        ), array(
            'class' => 'btn btn-blue'
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->