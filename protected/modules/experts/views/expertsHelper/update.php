<?php
/** @var $model ExpertsHelper */
/** @var $this ExpertsHelperControllerController */

$this->breadcrumbs = array(
    'Справочник экспертных советов' => array('/experts/ExpertsHelper/index'),
	'Редактирование',
);
?>

<div class="page-header">
    <h2>Редактирование "Экспертного совета"</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));