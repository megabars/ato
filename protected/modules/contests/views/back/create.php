<?php
/* @var $this ContestController */
/* @var $model Contest */

$this->breadcrumbs=array(
	'Конкурсы'=>array('/contests/back'),
	'Добавление',
);
?>

<h1>Новый конкурс</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>