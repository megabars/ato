<?php
/** @var $this AdminController */
/** @var $record Contact */

$this->breadcrumbs = array(
    'Контактная информация',
);
?>

<div class="page-header">
    <h2>Контакты</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/contact/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn fr" href="<?php echo $this->createUrl('/contact/back/create'); ?>">
        Добавить контакт
    </a>
</div>

<?php
$this->widget('application.widgets.adminGridView', array(
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
//            'name' => 'title',
            'header' => 'Наименование',
            'type' => 'raw',
            'value' => '($data->executive !== null) ? $data->executive->name : "Не указано"',
            'sortable' => true,
        ),
//        array(
//            'name' => 'alias',
//            'sortable' => true,
//        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));