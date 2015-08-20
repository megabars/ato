<?php
/** @var $model MailTemplate */
/** @var $this MailTemplateController */

$this->breadcrumbs = array(
	'Шаблоны' => array('/mailing/mailTemplate/index'),
	'Создание',
);
?>

<div class="page-header">
    <h2>Создание</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));