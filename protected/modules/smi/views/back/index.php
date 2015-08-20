<?php
/** @var $this AdminController */
/** @var $record Smi */

$this->breadcrumbs = array(
    'Публикации СМИ',
);
?>

<div class="page-header">
    <h2>СМИ</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/smi/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/smi/back/create'); ?>">
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
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'name' => 'date',
            'value' => '$data->date',
            'sortable' => true,
            'filter' => false,
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
                    'url' => 'Yii::app()->createUrl("/smi/front/view", array("id" => $data->id))',
                    'options' => array("target" => "_blank", 'class'=> 'view'),
                ),
            ),
        ),
    ),
));