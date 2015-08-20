<?php
/** @var $model Groups */
/** @var $this GroupsController */

$this->breadcrumbs = array(
	'Группы' => array('/mailing/groups/index'),
	'Создание',
);
?>

<div class="page-header">
    <h2>Создание</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));