<?php
/** @var $this AdminController */
/** @var $model Video */

$this->breadcrumbs = array(
    'Видеогалерея',
);
?>

<div class="page-header">
    <h2>Видеогалерея</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/video/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn fr" href="<?php echo $this->createUrl('/video/back/create'); ?>">
        Создать видео
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
            'name' => 'date',
//            'value' => 'date("d-m-Y H:i", $data->date)',
            'sortable' => true,
            'filter' => false,
        ),
        array(
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => true,
            'filter' => CHtml::activeDropDownList($model, 'state', PublicType::instance()->list),
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));