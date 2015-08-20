<?php
/* @var $this AdminController */
/* @var $model DocumentsFolder */
/* @var $form CActiveForm */
?>

<?php
if ($model->isNewRecord)
    $url = $this->createUrl('/documents/back/create');
else
    $url = $this->createUrl('/documents/back/update', array('id' => $model->id));


$form = $this->beginWidget('CActiveForm', array(
    'id' => 'documents-folder-form',
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
                        success: function() {
                            $("#folder_dialog").dialog("close");
                            form[0].reset();
                            $.fn.yiiGridView.update("folders-grid");
                        }
                    });
                    return false;
                }
            }')
));

?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model, 'title'); ?>
    <?php echo $form->textField($model, 'title', array('size' => 60)); ?>
    <?php echo $form->error($model, 'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'parent_id'); ?>
    <?php echo $form->dropDownList($model, 'parent_id', array(0=>'Нет')+CHtml::listData(DocumentsFolder::model()->findAllByAttributes(array('group_id' => $model->group_id)), 'id', 'title')); ?>
    <?php echo $form->error($model, 'parent_id'); ?>
</div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'description'); ?>
<!--            --><?php //echo $form->textArea($model, 'description'); ?>
<!--            --><?php //echo $form->error($model, 'description'); ?>
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'photo'); ?>
<!--            --><?php //$this->widget('FileUpload', array(
//                'model' => $model,
//                'attribute' => 'photo',
//                'htmlOptions' => array('id' => 'uploader'))); ?>
<!--            --><?php //echo $form->error($model, 'photo'); ?>
<!--        </div>-->

<div class="row">
    <?php echo $form->labelEx($model, 'state', array('style' => 'display: inline;')); ?>
    &nbsp;
    <?php echo $form->checkBox($model, 'state'); ?>
    <?php echo $form->error($model, 'state'); ?>
</div>

<?php echo $form->hiddenField($model, 'group_id');?>

<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
</div>

<?php $this->endWidget(); ?>

