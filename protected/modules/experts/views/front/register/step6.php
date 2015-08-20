<div id="step_6">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'expert-register-step6-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                $(".highlight-form").removeClass("loader");
                if(!hasError)
                    stepForm.submit();
                return false;
            }'
        )
    )); ?>

    <h4>Дополнительные сведения</h4>

    <div class="input-group">
        <div class="row">
            <?php echo $form->labelEx($model,'prospect'); ?>
            <?php echo $form->textArea($model,'prospect'); ?>
            <?php echo $form->error($model,'prospect'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'public_organization'); ?>
            <?php echo $form->textArea($model,'public_organization'); ?>
            <?php echo $form->error($model,'public_organization'); ?>
        </div>
    </div>

    <div class="input-group">
        <div class="row">
            <?php echo $form->labelEx($model,'expert_work'); ?>
            <?php echo $form->textArea($model,'expert_work'); ?>
            <?php echo $form->error($model,'expert_work'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'wish'); ?>
            <?php echo $form->textArea($model,'wish'); ?>
            <?php echo $form->error($model,'wish'); ?>
        </div>
    </div>

    <div class="input-group">
        <div class="row">
            <?php echo $form->labelEx($model,'project'); ?>
            <?php echo $form->textArea($model,'project'); ?>
            <?php echo $form->error($model,'project'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'additional_information'); ?>
            <div>&nbsp;</div>
            <?php echo $form->textArea($model,'additional_information'); ?>
            <?php echo $form->error($model,'additional_information'); ?>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'qualification'); ?>
        <?php echo $form->textArea($model,'qualification'); ?>
        <?php echo $form->error($model,'qualification'); ?>
    </div>

    <div class="row captcha clearfix">
        <div class="image">
            <?php $this->widget('CCaptcha',array('clickableImage'=>true, 'showRefreshButton'=>true,)); ?><br>
        </div>
        <div class="right">
            <?php echo $form->labelEx($model,'captcha'); ?>
            <?php echo $form->textField($model,'captcha', array('placeholder'=>'Символы с изображения')); ?>
            <?php echo $form->error($model,'captcha'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>