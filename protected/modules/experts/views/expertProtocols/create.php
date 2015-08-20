<?php
/** @var $model ExpertProtocols */
/** @var $this ExpertProtocolsController */

$this->breadcrumbs = array(
	'Протоколы заседаний' => array('/experts/expertProtocols/index'),
	'Создание протокола',
);
?>

<div class="page-header">
    <h2>Создание протокола</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));