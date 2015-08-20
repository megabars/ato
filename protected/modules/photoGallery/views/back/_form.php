<?php
/* @var $model PhotoGallery */
/* @var $this AdminController */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'gallery-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
        ),
    )); ?>

    <div class="form-left">

        <h1> <?php echo CHtml::encode($model->isNewRecord ? 'Создание фотогалереи' : 'Редактирование фотогалереи'); ?></h1>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'photos'); ?>
<!--            --><?php //$this->widget('FileUpload', array('model' => $model, 'attribute' => 'photos', 'multiple' => true)); ?>
<!--            </div>-->
<!--            --><?php //echo $form->error($model, 'photos'); ?>
<!--        </div>-->

        <div class="row">
            <?php echo $this->renderPartial('table', array('model' => $model)); ?>
        </div>
    </div>

    <div class="form-right">
        <div class="form-buttons">
            <button type="submit" class="btn icon icon-ok">Сохранить</button>
            <a href="<?php echo $this->createUrl('/photoGallery/back/delete', array('id' => $model->id))?>" class="btn btn-warning icon icon-remove">Удалить</a>
        </div>

        <h3>Свойства</h3>

        <div class="row">
            <?php echo $form->labelEx($model, 'date'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'PhotoGallery[date]',
                'value' => $model->date,
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

        <div class="row checkbox-list">
            <?php echo $form->checkBox($model, 'state'); ?>
            <?php echo $form->labelEx($model, 'state'); ?>
            <?php echo $form->error($model, 'state'); ?>
        </div>

        <h3>Миниатюра</h3>

        <div class="row">
            <?php echo $form->labelEx($model, 'photo'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
            <?php echo $form->error($model, 'photo'); ?>
        </div>

    </div>
    <?php $this->endWidget(); ?>
</div>