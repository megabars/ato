<?php
$this->breadcrumbs[] ='Общая информация';
?>


<div class="page-header">
    <h2>Общая информация</h2>
</div>


<?php echo $this->renderPartial('/back/menu',array('isNewRecord'=>$model->isNewRecord,'active'=>PeopleType::MAIN_INFO,'people_id'=>$model->id,'type'=>$model->type));?>

	<div class="form">

		<h3 style="margin-top: 0px">Общая информация<?php echo ($model->isNewRecord)?"":" - ".$model->full_name?></h3>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'people-form',
			'enableAjaxValidation'=>false,
		)); ?>

		<?php echo $form->errorSummary($model); ?>
		<div class="row">
			<?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'main_info')); ?>
			<?php echo $form->error($model,'main_info'); ?>
		</div>
		<?php if($model->type<People::LAW_CHILD){?>
		<div class="row">
			<?php echo $form->labelEx($model,'positionFile'); ?>
			<?php $this->widget('FileUpload', array('model' => $model,
				'isImage' => false, 'attribute' => 'positionFile','config' => array('allowedExtensions' => array("jpg", 'jpeg', 'gif', 'png', 'bmp','pdf', 'doc', 'docx')))); ?>
			<?php echo $form->error($model,'positionFile'); ?>
		</div>
		<?php } ?>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
		</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->