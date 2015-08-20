<?php
/* @var $this ScheduleController */
/* @var $model AppealSchedule */
/* @var $form CActiveForm */
/* @var $fields string */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'schedule-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/appeal/schedule/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#schedule_dialog").dialog("close");
                            $.fn.yiiGridView.update("schedule-grid");
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'people_id'); ?>
        <?php echo $form->dropDownList($model, 'people_id', CHtml::listData(People::model()->sorted()->findAll(), 'id', 'full_name')); ?>
        <?php echo $form->error($model, 'people_id'); ?>
    </div>

    <?php $this->renderPartial($fields, array(
        'model'=>$model,
        'form'=>$form,
    )) ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

<?php $this->endWidget(); ?>
</div>