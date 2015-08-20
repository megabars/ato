<?php
/** @var $model StaticPage */
/** @var $this AdminController */

$this->breadcrumbs = array(
    'Управление страницами',
);
?>

    <div class="page-header">
        <?php if($model->type_id == 1) : ?>
            <a href="https://inpage.metrika.yandex.ru/inpage/link_map?id=28522211&metric_filters=" target="_blank" class="fr">Посмотреть статистику</a>
        <?php endif; ?>
        <h2>Управление страницами "<?php echo RecordType::instance()->list[$model->type_id]; ?>"</h2>
    </div>

    <div class="list-group">
        <a class="btn btn-default btn-sm icons remove-all"
           href="<?php echo $this->createUrl('/pages/back/deleteAll'); ?>">
            Удаление
        </a>

        <a class="btn btn-sm icons white add-new fr"
           href="<?php echo $this->createUrl('/pages/back/create', array('type' => $model->type_id)); ?>">
            Добавить запись
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
            'sortable' => true,
            'filter' => false
        ),
        array(
            'header' => 'Опубликовано',
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
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/pages/back/update", array("id" => $data->id, "type" => $data->type_id))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/pages/back/delete", array("id" => $data->id, "type" => $data->type_id))',
                ),
//                'view' => array(
//                    'url' => 'Yii::app()->createUrl("/record/view", array("id" => $data->id))',
//                    'options' => array("target" => "_blank"),
//                ),
            ),
        ),
    ),
));