<?php
/* @var $this AdminController */
/* @var $model Video */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'gallery-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type', GalleryType::instance()->list); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>

    <!--    todo Вот здесь нужно грузить разные uploader'ы в зависимости от типа галереи-->

        <div class="row">
            <?php echo $form->labelEx($model, 'photos'); ?>
            <?php $this->widget('GalleryFileUpload', array('model' => $model, 'attribute' => 'photos')); ?>
            <?php echo $form->error($model, 'photos'); ?>
        </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'Video[date]',
            'value' => date('Y-m-d H:i', $model->date ? $model->date : time()),
            'mode' => 'datetime',
            'options'=>array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'state', array('style' => 'display: inline;')); ?>
        &nbsp;
        <?php echo $form->checkBox($model, 'state'); ?>
        <?php echo $form->error($model, 'state'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'photo'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
        <?php echo $form->error($model, 'photo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>