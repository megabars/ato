<?php
/* @var $this MailEmailListController */
/* @var $model MailEmailList */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'mail-email-list-form',
		'enableAjaxValidation' => false,
	)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'email'); ?>
		<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'first_name'); ?>
		<?php echo $form->textField($model, 'first_name', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'last_name'); ?>
		<?php echo $form->textField($model, 'last_name', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'surname'); ?>
		<?php echo $form->textField($model, 'surname', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'surname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'agreement'); ?>
		<?php echo $form->checkBox($model, 'agreement'); ?>
		<?php echo $form->error($model, 'agreement'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->