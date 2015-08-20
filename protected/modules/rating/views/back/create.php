<?php
/* @var $this ContestController */
/* @var $model Contest */

$this->breadcrumbs = array(
	'Оценка регулирующего воздействия проектов НПА и экспертиза НПА' => array('/rating/back', 'type' => $type),
	$name,
);
?>

<h1><?php echo $name ?>: создание</h1>

<?php
	$this->renderPartial('_form/'.$render, array(
		'model'	=>	$model,
		'types'	=>	$types,
	)); ?>