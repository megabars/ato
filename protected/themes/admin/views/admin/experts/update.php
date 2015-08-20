<?php
/** @var $model Experts */
/** @var $this ExpertsController */

$this->breadcrumbs = array(
	'Эксперты' => array('/admin/experts/index'),
	'Просмотр',
);
?>

<div class="page-header">
    <h2>Редактирование</h2>
</div>

<div class="list-group"></div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'model_resourse' => $model_resourse));