<?php
/** @var $model NavMenu */
/** @var $this MenuController */

$this->breadcrumbs = array(
    'Навигация' => $this->createUrl('/navigation/back/index'),
	'Управление меню' => array('menu/index'),
	'Создание меню',
);
?>

<div class="page-header">
    <h2>Создание меню</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));