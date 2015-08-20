<?php
/** @var $model Subscribe */
/** @var $this SubscribeController */

$this->breadcrumbs = array(
	'Подписчики' => array('/mailing/subscribe/index'),
	'Создание',
);
?>

<div class="page-header">
    <h2>Создание</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));