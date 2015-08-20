<?php
/** @var $model ExpertsHelper */
/** @var $this ExpertsHelperControllerController */

$this->breadcrumbs = array(
	'Справочник экспертных советов' => array('/experts/ExpertsHelper/index'),
	'Создание',
);
?>

<div class="page-header">
    <h2>Создание "Экспертного совета"</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));