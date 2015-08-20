<?php
/** @var $model MailSubscribe */
/** @var $this MailSubscribeController */

$this->breadcrumbs = array(
	'Рассылки' => array('/mailing/mailSubscribe/index'),
	'Редактирование',
);
?>

<div class="page-header">
    <h2>Редактирование</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));