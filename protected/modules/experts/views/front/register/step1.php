<div id="step_1">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'expert-register-step1-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                $(".highlight-form").removeClass("loader");
                if(!hasError)
                    stepForm.action();
                return false;
            }'
        )
    )); ?>

    <h4>Выбор экспертного совета</h4>
    <? if (isset($modelSettings->message)) { ?>
    <div class="row message"><?=$modelSettings->message?></div>
    <? } ?>
    <div class="row">
        <?php echo $form->labelEx($model,'portal_id'); ?>
        <div>
            <?php echo $form->radioButtonList($model,'portal_id', $model->subportal_list, array('class'=>'styled')); ?>
        </div>
        <?php echo $form->error($model,'portal_id'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>