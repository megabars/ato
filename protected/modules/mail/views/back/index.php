<?php
/** @var $this AdminController */
/** @var $model Mail */

$this->breadcrumbs = array(
    'Настройки почты',
);
?>

<h1>Настройки почты</h1>


<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'settings-mail-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'server_email'); ?>
        <?php echo $form->textField($model, 'server_email', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'server_email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type', array(SettingsMail::TYPE_SMTP => 'SMTP', SettingsMail::TYPE_SENDMAIL => 'Sendmail')); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'smtp_host'); ?>
        <?php echo $form->textField($model, 'smtp_host', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'smtp_host'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'smtp_port'); ?>
        <?php echo $form->textField($model, 'smtp_port'); ?>
        <?php echo $form->error($model, 'smtp_port'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'smtp_username'); ?>
        <?php echo $form->textField($model, 'smtp_username', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'smtp_username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'smtp_password'); ?>
        <?php echo $form->passwordField($model, 'smtp_password', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'smtp_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sendmail_path'); ?>
        <?php echo $form->textField($model, 'sendmail_path', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'sendmail_path'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'support_addr_1'); ?>
        <?php echo $form->textField($model, 'support_addr_1', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'support_addr_1'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'support_addr_2'); ?>
        <?php echo $form->textField($model, 'support_addr_2', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'support_addr_2'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>