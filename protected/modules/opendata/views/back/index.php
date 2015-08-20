<?php
/** @var $this AdminController */
/** @var $model Opendata */

$this->breadcrumbs = array(
    'Открытые данные',
);
?>

<div class="page-header">
    <h2>Открытые данные</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/opendata/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/opendata/category/index'); ?>">
        Список категорий
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/opendata/back/create'); ?>">
        Добавить набор данных
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
            'name' => 'id',
            'sortable' => false,
            'filter' => false,
            'header' => '',
            'type' => 'html',
            'value' => 'CHtml::link("Список версий", Yii::app()->createUrl("/opendata/version/index", array("id" => $data->id)))',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));