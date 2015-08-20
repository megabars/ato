<?php
/** @var $this AdminController */
/** @var $record News */

$this->breadcrumbs = array(
    'Новости',
);
?>

<div class="page-header">
    <h1>Новости</h1>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/news/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/news/back/create'); ?>">
        Создать новость
    </a>
<!--    <a class="btn btn-sm icons white listen fr" href="--><?php //echo $this->createUrl('/news/type'); ?><!--">-->
<!--        Категории новости-->
<!--    </a>-->
    <a class="btn btn-sm icons white listen fr" href="<?php echo $this->createUrl('/news/subscribers'); ?>">
        Подписчики
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
                    'url' => 'Yii::app()->createUrl("/news/front/view", array("id" => $data->id))',
                    'options' => array("target" => "_blank", 'class'=> 'view'),
                ),
            ),
        ),
    ),
));