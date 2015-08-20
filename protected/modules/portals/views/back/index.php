
<?php
/** @var $model Portal */
/** @var $this PortalController */

$this->breadcrumbs = array(
	'Структура',
	'Субпорталы',
);
?>

<div class="page-header">
    <h2>Управление субпорталами</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/portals/back/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn fr"
       href="<?php echo $this->createUrl('/portals/back/create'); ?>">
        Добавить субпортал
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
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array('name' => 'title'),
        array('name' => 'alias'),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => '"http://".$data->alias',
                    'options' => array("target" => "_blank", 'class' => 'view'),
                ),
            ),
        ),
    ),
));