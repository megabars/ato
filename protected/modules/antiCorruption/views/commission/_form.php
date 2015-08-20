<?php
/* @var $this CommissionController */
/* @var $model AcCommission */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'commission-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/antiCorruption/commission/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#commission_dialog").dialog("close");
                            window.location.reload(true)
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'decree'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model'=>$model,
            'attribute'=>'decree',
        )); ?>
        <?php echo $form->error($model, 'decree'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'regulation'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model'=>$model,
            'attribute'=>'regulation',
        )); ?>
        <?php echo $form->error($model, 'regulation'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->