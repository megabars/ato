<?php
/** @var $record Afisha */
/** @var $this AfishaController */

$this->breadcrumbs = array(
    'Календарь мероприятий',
);
?>

<div class="page-header">
    <h2>Календарь мероприятий</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/afisha/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/afisha/back/create'); ?>">
        Добавить мероприятие
    </a>
    <a class="btn btn-sm icons white settings fr" href="<?php echo $this->createUrl('/afisha/back/settings'); ?>">
        Настроить
    </a>
    <a class="btn btn-sm icons white add-new fr" href="#" onclick='$("#csv_dialog").dialog("open"); return false;'>
        Загрузить из CSV
    </a>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'csv_dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Загрузка из CSV',
        'autoOpen'=>false,
        'width'=>'500',
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),
));
$this->renderPartial('_csv_form', array('model' => $modelCsv));
$this->endWidget('zii.widgets.jui.CJuiDialog');


$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'id' => 'events',
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
            'name' => 'organizer',
            'sortable' => true,
        ),
        array(
            'name' => 'date',
            'value' => 'date("d-m-Y H:i", $data->date)',
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
                    'url' => 'Yii::app()->createUrl("/afisha/front/view", array("id" => $data->id))',
                    'options' => array("target" => "_blank", "class" => "view"),
                ),
            ),
        ),
    ),
));
?>