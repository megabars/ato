<?php
/** @var $model MailEmailList */
/** @var $this MailEmailListController */

$this->breadcrumbs = array(
	'Подписчики' => array('/mailing/mailEmailList/index'),
	'Создание',
);
?>

<div class="page-header">
    <h2>Создание</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));