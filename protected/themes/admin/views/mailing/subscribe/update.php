<?php
/** @var $model Subscribe */
/** @var $this SubscribeController */

$this->breadcrumbs = array(
	'Подписчики' => array('/mailing/subscribe/index'),
	'Редактирование',
);
?>

<div class="page-header">
    <h2>Редактирование</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));