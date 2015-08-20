<?php
/* @var $this AdminController */
/* @var $detail ContactDetails */
/* @var $form CActiveForm */
?>


<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'contact-details-form',
        'action' => '/contact/details/processing',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/contact/details/processing",
                        data: form.serialize(),
                        success: function() {
                            $("#contact_details_dialog").dialog("close");
                            form[0].reset();
                            $.fn.yiiGridView.update("contact_details");
                        }
                    });
                }
                return false;
            }')
    )); ?>

        <?php if(isset($model->id))
            echo $form->hiddenField($model, 'id'); ?>

        <?php echo $form->hiddenField($model, 'contact_id'); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'type'); ?>
            <?php echo $form->dropDownList($model, 'type', ContactType::instance()->list); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'value'); ?>
            <?php echo $form->textField($model, 'value', array('size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'value'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textField($model, 'description', array('size' => 60)); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>

<script>
    masked($('#ContactDetails_type').val());

    $('#ContactDetails_type').on('change', function(){
        masked($(this).val());
    });

    function masked(value){
        var mask = "+7(9999) 999-999";
        if(value!=<?php echo ContactType::EMAIL; ?> && value!=<?php echo ContactType::WEB; ?> ){
            $("#ContactDetails_value").mask(mask,{'placeholder':'*'});
        } else {
            $("#ContactDetails_value").unmask(mask);
        }
    }
</script>