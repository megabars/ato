<?php
/** @var $this AdminController */
/** @var $record News */

$this->breadcrumbs = array(
    'Стенограммы',
);
?>

<div class="page-header">
    <h1>Стенограммы</h1>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/stenogramm/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/stenogramm/back/create'); ?>">
        Создать стенограмму
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
//        array(
//            'name' => 'author',
//            'sortable' => true,
//        ),
        array(
            'name' => 'date',
            'value' => 'date("d-m-Y H:i", strtotime($data->date))',
            'sortable' => true,
        ),
        array(
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => false,
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/stenogramm/front/view", array("id" => $data->id))',
                    'options' => array("target" => "_blank", 'class'=> 'view'),
                ),
            ),
        ),
    ),
));