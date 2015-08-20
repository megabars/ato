
<?php
/** @var $model Experts */
/** @var $this ExpertsController */

$this->breadcrumbs = array(
	'Эксперты',
);
?>

<div class="page-header">
    <h2>Эксперты</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/admin/experts/deleteAll'); ?>">
        Удаление
    </a>
</div>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        'fio',
//        array(
//            'name'=>'type',
//            'type'=>'raw',
//            'value'=>'$data->getTypeLabel()',
//            'filter'=>@Experts::$type_label,
//        ),
        array(
            'name'=>'date',
            'type'=>'raw',
            'value'=>'date("Y-m-d H:i", strtotime($data->date))',
            'filter'=>false,
        ),
//        array(
//            'name'=>'sovet_id',
//            'type'=>'raw',
//            'value'=>'$data->getSovetLabel()',
//            'filter'=>@Experts::$sovet,
//        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}'
        ),
    ),
));