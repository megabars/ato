<?php
/* @var $this PageFactsController */
/* @var $model PageFacts */
/* @var $form CActiveForm */

?>
<?php
if ($model->isNewRecord)
    $url = $this->createUrl('/pages/pageFacts/create');
else
    $url = $this->createUrl('/pages/pageFacts/update', array('id' => $model->id));

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-facts-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
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
                            $("#facts_dialog").dialog("close");
                            form[0].reset();
                            $.fn.yiiGridView.update("factsGrid");
                        }
                    });
                }
                return false;
            }')
)); ?>

<p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

<?php echo $form->hiddenField($model, 'page_id'); ?>

<div class="row">
    <?php echo $form->labelEx($model, 'text'); ?>
    <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
    <?php echo $form->error($model, 'text'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
</div>

<?php $this->endWidget(); ?>


