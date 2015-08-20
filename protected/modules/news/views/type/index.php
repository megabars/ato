<?php
/** @var $this AdminController */
/** @var $record News */

$this->breadcrumbs = array(
    'Новости' => 'back/index',
    'Категории новости',
);
?>

<div class="page-header">
    <h2>Категории новости</h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all" href="<?php echo $this->createUrl('/news/type/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/news/type/create'); ?>">
        Создать категорию новости
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
            'name' => 'alias',
            'sortable' => true,
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));