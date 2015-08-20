<?php
/** @var $model MailGroup */
/** @var $this MailGroupController */

$this->breadcrumbs = array(
	'Группы' => array('mailing/mailGroup/index'),
	'Создание',
);
?>

<div class="page-header">
    <h2>Создание</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));