<?php
/* @var $this PageFactsController */
/* @var $model PageFacts */
/* @var $form CActiveForm */

?>
<?php
if ($model->isNewRecord)
    $url = $this->createUrl('/pages/PageExecutives/create');
else
    $url = $this->createUrl('/pages/PageExecutives/update', array('id' => $model->id));

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-executives-form',
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
                            $("#executives_dialog").dialog("close");
                            form[0].reset();
                            $.fn.yiiGridView.update("executivesGrid");
                        }
                    });
                }
                return false;
            }')
)); ?>

<p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

<?php echo $form->hiddenField($model, 'page_id'); ?>

<div class="row">
    <?php echo $form->labelEx($model, 'executive_id'); ?>
    <div>
        <?php echo $form->dropDownList($model, 'executive_id', CHtml::listData(Executive::model()->findAll(), 'id', 'name'), array('class'=>'chosen-select')); ?>
    </div>
    <?php echo $form->error($model, 'executive_id'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'url'); ?>
    <?php echo $form->textField($model, 'url'); ?>
    <?php echo $form->error($model, 'url'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
</div>

<?php $this->endWidget(); ?>


