<?php
/** @var $model MailGroupEmailList */
/** @var $this MailGroupEmailListController */

$this->breadcrumbs = array(
	'Группа подписчиков - '.@$this->group->name => array('/mailing/mailGroupEmailList/index/group_id/'.@$this->group->id),
	'Создание',
);
?>

<div class="page-header">
    <h2>Создание</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));