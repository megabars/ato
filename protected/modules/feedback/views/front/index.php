<div class="feedback-modal">

    <div class="head">
        <?php echo Yii::t('app', 'Обратная связь'); ?>
    </div>

    <div class="body">
        <div class="desc">
            <?php echo Yii::t('app', 'Портал Томской области приветствует Вас'); ?>
        </div>

        <div class="feedback-type">
            <?php foreach (FeedbackType::instance()->list as $index => $item) : ?>
                <a href="" data-id="<?php echo $index; ?>" class="<?php echo ($index == $type) ? 'active' : ''; ?>">
                    <?php echo $item; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <p style="padding-top: 20px;">
            <a href="<?php echo $this->createUrl('/faqs/front/index'); ?>"><?php echo Yii::t('app', 'Часто задаваемые вопросы'); ?></a>
        </p>

        <div class="feedback form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'feedback-form',
                'htmlOptions' => array(
                    'class' => 'feedback_form',
                ),
                'enableAjaxValidation' => TRUE,
                'enableClientValidation' => TRUE,
                'clientOptions' => array(
                    'validateOnSubmit' => TRUE,
                ),
            )); ?>

            <div class="hint"><span class="required">*</span> — <?php echo Yii::t('app', 'Поля обязательные для заполнения'); ?></div>

            <?php echo $form->hiddenField($model, 'type', array('class'=>'feed-type', 'value'=>$type)); ?>

            <div class="input-group row clearfix">
                <div class="row">
                    <?php echo $form->labelEx($model, 'fio'); ?>
                    <?php echo $form->textField($model, 'fio', array('maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'fio', array('class' => 'error_msg')); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email', array('maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'email', array('class' => 'error_msg')); ?>
                </div>
            </div>


            <div class="row">
<!--                --><?php //echo $form->labelEx($model, 'text', array('id'=>'feedback_text')); ?>
                <label><?php echo Yii::t('app', 'Ваш вопрос'); ?></label>
                <?php echo $form->textArea($model, 'text', array('rows' => 7)); ?>
                <?php echo $form->error($model, 'text', array('class' => 'error_msg')); ?>
            </div>

            <?php if (CCaptcha::checkRequirements()): ?>
                <div class="row captcha clearfix">
                    <div class="image">
                        <?php $this->widget('CCaptcha',array(
                            'clickableImage'=>true,
                            'showRefreshButton'=>true,
                            'id' => uniqid('das')
                        )); ?><br>
                    </div>
                    <div class="right">
                        <?php echo $form->labelEx($model,'captcha'); ?>
                        <?php echo $form->textField($model,'captcha', array('placeholder'=> Yii::t('app', 'Символы с изображения'))); ?>
                        <?php echo $form->error($model,'captcha'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php echo CHtml::submitButton(Yii::t('app', 'Отправить'), array('class' => 'btn')); ?>
                <a href="#" id="close-fancy"><?php echo Yii::t('app', 'Отмена'); ?></a>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>

</div>

<style type="text/css">
    .error_msg {
        color: red;
    }
</style>