<?php
/** @var $record PhotoGallery */
/** @var $this AdminController */

$this->breadcrumbs = array(
    'Фотогалерея',
);
?>

<div class="page-header">
    <h2>Фотогалерея</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/photoGallery/back/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn fr" href="<?php echo $this->createUrl('/photoGallery/back/create'); ?>">
        Создать галерею
    </a>
</div>

<?php

/**
 * Грид с галлереями
 */
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
            'filter' => false
        ),
        array(
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => false,
            'filter' => CHtml::activeDropDownList($model, 'state', PublicType::instance()->list),
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/photoGallery/front/view", array("galleryId" => $data->id))',
                    'options' => array("target" => "_blank", "class" => 'view'),
                ),
            ),
        ),
    ),
));