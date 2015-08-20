<?php
/** @var $this AdminController */
/** @var $record Guber */

$this->breadcrumbs = array(
    'Губернатор',
);
?>

<div class="page-header">
    <h2>Губернатор</h2>
</div>


<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/gubernator/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/gubernator/back/create'); ?>">
        Создать фразу
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/gubernator/back/info'); ?>">
        Изменить информацию о губернаторе
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
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => false,
            'filter' => CHtml::activeDropDownList($model, 'state', PublicType::instance()->list),
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/")',
                    'options' => array("target" => "_blank"),
                ),
            ),
        ),
    ),
));