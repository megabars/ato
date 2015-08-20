<?php
/* @var $this AdminController */
/* @var $model Afisha */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <style>
        .ui-datepicker-calendar {display: none;}​
    </style>

    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'PublicReport[date]',
            'value' => $model->date,
            'mode' => 'date',
            'options'=>array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'changeMonth'=>true,
                'changeYear'=>true,
                'yearRange'=>'2014:2099',
                'showButtonPanel' => true,
                'onClose' => 'js:function(){
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $("#PublicReport_date").datepicker("setDate", new Date(year, month, 1));
                }',
            )
        ));
        ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'file',
            'allowedExtensions' => array('pdf'),
            'isImage' => false)); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type', array(1=>'Форма 1', 2=>'Форма 2')) ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

<?php $this->endWidget(); ?>
</div>