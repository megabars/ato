<?php
/* @var $this SubscribersController */
/* @var $model NewsSubscribers */

$this->breadcrumbs=array(
    'Новости' => '/news/back/index',
	'Подписчики',
); ?>

<div class="page-header">
    <h2>Подписчики</h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all" href="<?php echo $this->createUrl('/news/subscribers/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/news/subscribers/create'); ?>">
        Добавить подписчика
    </a>
</div>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => true,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'name' => 'subscriber',
            'sortable' => true,
        ),
        array(
            'name' => 'email',
            'sortable' => true,
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
)); ?>
