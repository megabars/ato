<?php
/** @var $model MailEmailList */
/** @var $this MailEmailListController */

$this->breadcrumbs = array(
	'Группа подписчиков - '.@$this->group->name => array('/mailing/mailGroupEmailList/index/group_id/'.@$this->group->id),
	'Создание',
);
?>

<div class="page-header">
    <h2>Добавить файлом</h2>
</div>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'mail-email-list-file-form',
	'enableAjaxValidation' => false,
)); ?>

<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'file'); ?>
		<?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'file', 'config' => array('allowedExtensions'=>array('csv')))); ?>
		<?php echo $form->error($model, 'file'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->


<div class="form">
	<?php if(!empty($info))
	{
		echo "Количество - ".count($info)."<br>";
		foreach($info as $e=>$i)
			echo "Email - $e: $i<br>";

	}
	?>
	</div>

