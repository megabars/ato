<div class="page-header">
    <h2><?php echo $this->pageTitle?></h2>
</div>
<p>Для возможности сортировки выберите конкретный тип</p>
<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/people/'.Yii::app()->controller->id.'/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/people/'.Yii::app()->controller->id.'/create'); ?>">
        Добавить
    </a>
</div>

<?php
$this->widget('application.widgets.sortableGridView', array(
    'dataProvider' => $model->search($this->type),
    'filter' => $model,
    'enablePagination' => true,
    'initWithoutPager' => true,
    'enableSorting' => true,
    'sortUrl' => '/people/back/sort',
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'name'=>'photo',
            'type'=>'raw',
            'value'=>'($data->photo)?CHtml::image($data->getSmallUrl("photo")):""',
            'filter'=>'',
            'sortable' => false,
            'htmlOptions' => array(
                'class' => 'photos'
            )
        ),
        'full_name',
        array(
            'name'=>'type',
            'type'=>'raw',
            'filter' => People::getTypeGroupLabels($this->type),
            'value'=>'$data->getTypeLabel()',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}{drag}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/people/'.Yii::app()->controller->id.'/update", array("people_id" => $data->id))',
                ),
                'drag' => array(
                    'label'=>'',
                    'options'=>array(
                        'class' => 'drag',
                    )
                ),
            ),
        ),
    ),
));