<?php
/** @var $this AdminController */
/** @var $model CategoryPost */

$this->pageTitle = 'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера';

$this->breadcrumbs = array(
    'Противодействие коррупции' => $this->createUrl('/antiCorruption/back/index'),
    'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера' => $this->createUrl('/antiCorruption/public/index'),
    'Список категорий',
);
?>

<div class="page-header">
    <h2>Список категорий</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/antiCorruption/category/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/antiCorruption/category/create'); ?>">
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
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));