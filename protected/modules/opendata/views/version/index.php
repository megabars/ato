<?php
/** @var $this AdminController */
/** @var $model OpendataVersion */

$this->breadcrumbs = array(
    'Открытые данные' => $this->createUrl('/opendata/back/index'),
    $opendata->title,
);
?>

<div class="page-header">
    <h2>Открытые данные</h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all" href="<?php echo $this->createUrl('/opendata/version/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/opendata/version/create', array('id' => $opendata->id)); ?>">
        Добавить версию
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
            'name' => 'date',
            'sortable' => true,
            'filter' => false,
            'type' => 'html',
            'value' => 'date("Y-m-d H:i", $data->date)',
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));