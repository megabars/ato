
<?php
/** @var $model ExpertProtocols */
/** @var $this ExpertProtocolsController */

$this->breadcrumbs = array(
	'Протоколы заседаний',
);
?>

<div class="page-header">
    <h2>Протоколы заседаний</h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all"
       href="<?php echo $this->createUrl('/experts/expertProtocols/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/experts/expertProtocols/create'); ?>">
        Добавить
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
        array('name' => 'number'),
        array('name' => 'type'),
        array('name' => 'date', 'filter' => false),
        array(
            'name' => 'expertsHelperIds',
            'type' => 'raw',
            'value' => '$data->getAuthorsString()',
            'filter' => CHtml::listData(ExpertsHelper::model()->findAll(), 'id', 'name')
        ),
        array('name' => 'descr'),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/expertprotocols/view", array("id" => $data->id))',
                    'options' => array("target" => "_blank"),
                ),
            ),
        ),
    ),
));