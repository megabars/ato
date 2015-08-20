<?php
/* @var $this ContestController */
/* @var $model Contest */

$this->breadcrumbs=array(
	'Contests'=>array('/contests/back'),
	$model->title => array('view', 'id'=>$model->title),
	'Update',
);

?>

<h1><?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>