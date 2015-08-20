<?php
/** @var $this AdminController */
/** @var $model Feedback */

$this->breadcrumbs = array(
    'Обратная связь',
);
?>

<div class="page-header">
    <h2>Обратная связь</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/feedback/back/deleteAll'); ?>">
        Удаление
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
        array(
            'name' => 'fio',
            'sortable' => true,
        ),
//        array(
//            'name' => 'phone',
//            'sortable' => true,
//        ),
        array(
            'name' => 'email',
            'sortable' => true,
        ),
        array(
            'name' => 'type',
            'sortable' => true,
            'filter' => CHtml::activeDropDownList($model, 'type', array('' => 'Все') + FeedbackType::instance()->list),
            'value' => 'FeedbackType::instance()->list[$data->type]',
        ),
        array(
            'name' => 'date',
            'filter' => false,
            'value' => '$data->date ? date("d-m-Y H:i", $data->date) : ""',
            'sortable' => true,
        ),
//        array(
//            'name' => 'date',
//            'value' => 'date("d-m-Y H:i", strtotime($data->date))',
//            'sortable' => true,
//            'filter' => false,
//        ),
//        array(
//            'name' => 'new',
//            'header' => 'Необработанные/обработанные',
//            'sortable' => true,
//            'filter' => CHtml::activeDropDownList($model, 'new', array('' => 'Все', 0 => 'Да', 1 => 'Нет')),
//            'value' => '($data->new == 0) ? "Да" : "Нет"',
//        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{view}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/feedback/back/view", array("id" => $data->id))',
                    'options' => array(
                        "target" => "_blank",
                        "class" => "view"
                    ),
                ),
            ),
        ),
    ),
));