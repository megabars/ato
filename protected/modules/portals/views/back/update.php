<?php
/** @var $model Portal */
/** @var $this PortalController */

$this->breadcrumbs = array(
    'Субпорталы' => array('/portals/back'),
	'Редактирование Portal',
);
?>

<div class="page-header">
    <h2>Редактирование Portal</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));