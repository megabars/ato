<?php
/* @var $this ContestController */
/* @var $model Contest */

$this->breadcrumbs=array(
	'Оценка регулирующего воздействия проектов НПА и экспертиза НПА' => '/rating/back',
	$name  => array('/rating/back', 'type' => $type),
	$model->title
);
?>

<h1><?php echo $model->title; ?></h1>

<?php
$this->renderPartial('_form/'.$render, array(
	'model'	=>	$model,
	'types'	=>	$types,
)); ?>