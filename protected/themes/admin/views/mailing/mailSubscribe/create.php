<?php
/** @var $model MailSubscribe */
/** @var $this MailSubscribeController */

$this->breadcrumbs = array(
	'Рассылки' => array('/mailing/mailSubscribe/index'),
	'Создание',
);
?>

<div class="page-header">
    <h2>Создание</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));