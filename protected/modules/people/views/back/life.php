<?php
$this->breadcrumbs[] ='Биография';
?>

<div class="page-header">
    <h2>Биография</h2>
</div>

<?php echo $this->renderPartial('/back/menu',array('isNewRecord'=>$model->isNewRecord,'active'=>PeopleType::LIFE,'people_id'=>$model->id,'type'=>$model->type));?>

	<div class="form">

		<h3 style="margin-top: 0px">Биография<?php echo ($model->isNewRecord)?"":" - ".$model->full_name?></h3>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'people-form',
			'enableAjaxValidation'=>false,
		)); ?>

		<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'life')); ?>
		<?php echo $form->error($model,'life'); ?>
	</div>
		<div class="row buttons">
			<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
		</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->