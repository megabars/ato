<?php
/** @var $model Experts */
/** @var $this ExpertsController */

$this->breadcrumbs = array(
	'Эксперты' => array('/admin/experts/index'),
	'Просмотр',
);
?>

<div class="page-header">
    <h2>Просмотр</h2>
</div>

<div class="list-group"></div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name' => 'type',
			'type' => 'raw',
			'value' => CHtml::encode(Experts::$type_label[$model->type]),
		),
		array(
			'name' => 'type',
			'type' => 'raw',
			'value' => ($model->sovet_id != 0) ? CHtml::encode(Experts::$sovet[$model->sovet_id]) : "Не указан",
		),
		'fio',
		'portal_id',
		'phone',
		'email',
		'contact_address',
		'skills',
		'education',
		'scientific',
		'profession_skill',
		'history',
		'experience',
	),
	'cssFile' => Yii::app()->controller->assetsBase . '/css/gridview.css',
	'htmlOptions' => array(
		'class' => 'items'
	)
)); ?>

<div class="page-header">
	<h2>Ресурсы в сети</h2>
</div>

<?php
if(!empty($model->resources))
	foreach($model->resources as $resources)
		echo CHtml::link($resources->url,$resources->url)."<br>";

?>