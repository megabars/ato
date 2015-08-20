<?php
/** @var $this VoteController */
/** @var $record Vote */

$this->breadcrumbs=array(
	'Опросы',
);
?>

<div class="page-header">
    <h2>Опросы</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/vote/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/vote/back/create'); ?>">
        Добавить опрос
    </a>
</div>

<?php
$this->widget('application.widgets.adminGridView', array(
	'id'=>'vote-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'enablePagination' => true,
    'enableSorting' => true,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
	'columns'=>array(
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
//            'name' => 'type',
//            'value' => 'VoteType::instance()->list[$data->type]',
//            'filter' => VoteType::instance()->list,
//            'sortable' => false,
//        ),
		array(
			'header' => '',
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{delete}',
			'buttons' => array(
				'view' => array(
					'url' => 'Yii::app()->controller->createUrl("/vote/front/view", array("id" => $data->id))',
				),
			),
		),
	),
));