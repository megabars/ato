<?php
/* @var $this FileController */
/* @var $model AcFile */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'map-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/map/back/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#map_dialog").dialog("close");
                            $.fn.yiiGridView.update("map-grid");
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

    <div class="row">
        <?php echo $form->labelEx($model,'head'); ?>
        <?php echo $form->textField($model, 'head'); ?>
        <?php echo $form->error($model,'head'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'area'); ?>
        <?php echo $form->textField($model, 'area'); ?>
        <?php echo $form->error($model,'area'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'people'); ?>
        <?php echo $form->textField($model, 'people'); ?>
        <?php echo $form->error($model,'people'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'site'); ?>
        <?php echo $form->textField($model, 'site'); ?>
        <?php echo $form->error($model,'site'); ?>
    </div>

    <div class="row">
        <div class="checkbox-list">
            <?php echo $form->checkBox($model, 'is_city'); ?>
            <?php echo $form->labelEx($model, 'is_city', array('style' => 'display: inline;')); ?>
            <?php echo $form->error($model, 'is_city'); ?>
        </div>
    </div>

    <fieldset class="disabled">
        <legend>Данные для построения SVG карты</legend>
        <div class="row">
            <?php echo $form->labelEx($model,'path'); ?>
            <?php echo $form->textField($model, 'path'); ?>
            <?php echo $form->error($model,'path'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'pos_x'); ?>
            <?php echo $form->textField($model, 'pos_x'); ?>
            <?php echo $form->error($model,'pos_x'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'pos_y'); ?>
            <?php echo $form->textField($model, 'pos_y'); ?>
            <?php echo $form->error($model,'pos_y'); ?>
        </div>
    </fieldset>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->