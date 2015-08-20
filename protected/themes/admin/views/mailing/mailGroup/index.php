
<?php
/** @var $model MailGroup */
/** @var $this MailGroupController */

$this->breadcrumbs = array(
	'Группы',
);
?>

<div class="page-header">
    <h2>Группы</h2>
</div>

<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::GROUP));?>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/mailing/mailGroup/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/mailing/mailGroup/create'); ?>">
        Добавить
    </a>
</div>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => false,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        'name',
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{subscriber} {update} {delete}',
            'buttons' => array(
                'subscriber' => array(
                    'label' => 'Подписчики',
                    'imageUrl' => $this->assetsBase . '/images/subscriber.png',
                    'url' => 'Yii::app()->createUrl("/mailing/mailGroupEmailList/index", array("group_id" => @$data->id))',
                ),
            ),
        ),
    ),
));