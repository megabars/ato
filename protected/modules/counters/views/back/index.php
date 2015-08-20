<?php
/** @var $this AdminController */
/** @var $record Counters */

$this->breadcrumbs = array(
    'Счетчики',
);
?>

<div class="page-header">
    <h2>Счетчики</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/counters/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn fr" href="<?php echo $this->createUrl('/counters/back/create'); ?>">
        Создать счетчик
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
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));