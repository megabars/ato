<?php
/* @var $this SubscribersController */
/* @var $model NewsSubscribers */
/* @var $form CActiveForm */
?>
<div class="feedback-modal">

    <div class="head"><?php echo Yii::t('app', 'Подписка на новости'); ?></div>

    <div class="body">
        <div class="form feedback">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'news-subscribers-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
            )); ?>

            <p class="note"><?php echo Yii::t('app', 'Поля с <span class="required">*</span> обязательны для заполнения.'); ?></p>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <?php echo $form->labelEx($model,'subscriber'); ?>
                <?php echo $form->textField($model,'subscriber',array('maxlength'=>500)); ?>
                <?php echo $form->error($model,'subscriber'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'email'); ?>
                <?php echo $form->textField($model,'email',array('maxlength'=>255)); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Подписаться'), array('class' => 'btn')); ?>
                <a href="#" id="close-fancy"><?php echo Yii::t('app', 'Отмена'); ?></a>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
</div>