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
    <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($model, 'title'); ?>
</div>

<?php
echo $form->hiddenField($model, 'group_id');
$model->state = 1;
echo $form->hiddenField($model, 'state');
?>

<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
</div>

<?php $this->endWidget(); ?>
