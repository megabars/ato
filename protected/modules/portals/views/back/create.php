<?php
/** @var $model Portal */
/** @var $this PortalController */

$this->breadcrumbs = array(
	'Субпорталы' => array('/portals/back'),
	'Создание субпортала',
);
?>

<div class="page-header">
    <h2>Создание субпортала</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));