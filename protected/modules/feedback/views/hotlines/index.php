<?php
/** @var $this AdminController */
/** @var $model Staff */

$this->breadcrumbs = array(
    'Горячие линии',
);
?>

<div class="page-header">
    <h2>Горячие линии</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/feedback/hotlines/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn fr" href="<?php echo $this->createUrl('/feedback/hotlines/create'); ?>">
        Создать запись
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
            'name' => 'name',
            'sortable' => true,
        ),
        array(
            'name' => 'phone',
            'sortable' => true,
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));