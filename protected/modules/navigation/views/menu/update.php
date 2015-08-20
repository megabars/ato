<?php
/** @var $model NavMenu */
/** @var $this MenuController */

$this->breadcrumbs = array(
    'Управление меню' => array('menu/index'),
	'Редактировать меню',
);
?>

<div class="page-header">
    <h2>Редактировать меню</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));

