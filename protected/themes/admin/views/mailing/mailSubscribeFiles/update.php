<?php
/** @var $model MailSubscribeFiles */
/** @var $this MailSubscribeFilesController */

$this->breadcrumbs = array(
	'Рассылки' => array('/mailing/mailSubscribe/index'),
	'Файлы рассылки' => array('/mailing/mailSubscribeFiles/index/subscribe/'.@$this->subscribe->id),
	'Редактирование',
);
?>

<div class="page-header">
    <h2>Редактирование</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));