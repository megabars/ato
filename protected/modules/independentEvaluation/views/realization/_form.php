<?php
/* @var $this FileController */
/* @var $model IeFile */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'realization-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/independentEvaluation/realization/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#realization_dialog").dialog("close");
                            $.fn.yiiGridView.update("realization-grid");
                        }
                    });
                    return false;
                }
            }')
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'link'); ?>
        <?php echo $form->textField($model, 'link'); ?>
        <?php echo $form->error($model,'link'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'portal_group_id'); ?>
        <?php echo $form->dropDownList($model, 'portal_group_id', CHtml::listData(PortalGroup::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model,'portal_group_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'executive_id'); ?>
        <?php echo $form->dropDownList($model, 'executive_id', CHtml::listData(Executive::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model,'executive_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->