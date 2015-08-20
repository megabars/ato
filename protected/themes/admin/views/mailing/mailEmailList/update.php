<?php
/** @var $model MailEmailList */
/** @var $this MailEmailListController */

$this->breadcrumbs = array(
	'Подписчики' => array('/mailing/mailEmailList/index'),
	'Редактирование',
);
?>

<div class="page-header">
    <h2>Редактирование</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));