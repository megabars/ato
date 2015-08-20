<?php
/** @var $model Experts */
/** @var $this BackController */


$this->pageTitle = 'База данных экспертов';

$this->breadcrumbs = array(
//    'Экспертные советы' => '/experts/council',
    $this->pageTitle
);
?>

<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/experts/back/deleteAll'); ?>">Удалить выбранные</a>

    <?php if ($hasFileExport) { ?>
    <a class="btn fr" href="<?php echo $this->createUrl('/uploads/experts.csv'); ?>">Скачать файл экспорта (<?=$fileCreated?>)</a>
     <?php } ?>

    <a class="btn fr export-all" href="<?php echo $this->createUrl('/experts/back/exportAll'); ?>">Экспортировать выбранные</a>
    <a class="btn fr" target="_blank" href="<?php echo $this->createUrl('/experts/front/register'); ?>">Добавить эксперта</a>
</div>
<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/experts/back',
    'id' => 'experts-grid',
    'enableSorting' => true,
    'summaryText' => '',
    'ajaxUpdate' => true,
    'template' => "{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'name' => 'date',
        ),
        array(
            'name' => 'fio',
        ),
        array(
            'name'=>'expert_council_id',
            'type' => 'raw',
//            'value'=>'$data->expert_council->name',
//            'filter' => CHtml::dropDownList('Experts[expert_council_id]', $model->expert_council_id, array(''=>'Все')+CHtml::listData(Portal::model()->findAllByAttributes(array('theme'=>'expert')),'id','title'))
        ),
        array(
            'name' => 'state',
            'type' => 'raw',
            'sortable' => true,
            'value' => '$data::$statuses[$data->state]',
            'filter' => CHtml::dropDownList('Experts[state]', $model->state, array(''=>'Все')+Experts::$statuses)
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
)); ?>