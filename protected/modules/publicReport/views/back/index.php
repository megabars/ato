<?php
/** @var $model PublicReport */
/** @var $this BackController */

$this->breadcrumbs = array(
    'Формы публичной отчетности',
);
?>

<div class="page-header">
    <h2>Формы публичной отчетности</h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all" href="<?php echo $this->createUrl('/publicReport/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/publicReport/back/create'); ?>">
        Добавить форму
    </a>
</div>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'id' => 'public_reports',
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
            'name' => 'date',
            'sortable' => true,
        ),
        array(
            'name' => 'file',
            'type' => 'raw',
            'value' => '($data->file)? CHtml::link("Посмотреть", $data->getFileUrl($data->file), array("target"=>"_blank")):""',
            'sortable' => false,
        ),
        array(
            'name' => 'type',
            'type' => 'raw',
            'value' => '"Форма ".$data->type',
            'sortable' => false,
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));
?>