<?php
/* @var $this FileController */
/* @var $model IeFile */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'groups-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/portals/groups/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#groups_dialog").dialog("close");
                            $.fn.yiiGridView.update("groups-grid");
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->