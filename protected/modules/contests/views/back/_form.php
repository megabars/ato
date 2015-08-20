<?php
/* @var $this ContestController */
/* @var $model Contest */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contest-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны для заполения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'org'); ?>
		<?php echo $form->textField($model,'org',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'org'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_small'); ?>
		<?php echo $form->textArea($model,'description_small',array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description_small'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'date_start'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'name' => 'Contest[date_start]',
			'value' => date('Y-m-d', $model->date_start ? $model->date_start : time()),
			'options'=>array(
				'showAnim' => 'fold',
				'dateFormat' => 'yy-mm-dd',
			),
		));
		?>
		<?php echo $form->error($model, 'date_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'date_end'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'name' => 'Contest[date_end]',
			'value' => date('Y-m-d', $model->date_end ? $model->date_end : time()),
			'options'=>array(
				'showAnim' => 'fold',
				'dateFormat' => 'yy-mm-dd',
			),
		));
		?>
		<?php echo $form->error($model, 'date_end'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'date_placed'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'name' => 'Contest[date_placed]',
			'value' => date('Y-m-d', $model->date_placed ? $model->date_placed : time()),
			'options'=>array(
				'showAnim' => 'fold',
				'dateFormat' => 'yy-mm-dd',
			),
		));
		?>
		<?php echo $form->error($model, 'date_placed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->dropDownList($model,'state', array(
			$model::STATUS_OPENED => 'Открытый',
			$model::STATUS_CLOSED => 'Завершенный',
			$model::STATUS_ARCHIVED => 'В архиве',
		)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row" id="file-input" <?php echo ($model->state == 0) ? '' : ''; ?>>
		<?php echo $form->labelEx($model, 'file'); ?>
		<?php $this->widget('FileUpload', array(
            'isImage' => false,
			'model' => $model,
			'attribute' => 'file',
			'config' => array('allowedExtensions' => array('pdf')))); ?>
		<?php echo $form->error($model, 'file'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class' => 'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	$(document).ready(function(){
		$('#Contest_state').change(function(){
			var state = $("#Contest_state option:selected").val();
			if (state == 0)
				$('#file-input').hide();
			else
				$('#file-input').show();
		})
	})

</script>