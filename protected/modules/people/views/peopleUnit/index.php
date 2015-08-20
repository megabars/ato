<?php
$this->breadcrumbs[]='Подразделения';
?>

<div class="page-header">
    <h2>Подразделения<?php echo ($this->people)?" - ".$this->people->full_name:""?></h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/people/peopleUnit/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn fr"
       href="<?php echo $this->createUrl('/people/peopleUnit/create',array('people_id'=>@$this->people->id,)); ?>">
        Добавить
    </a>
</div>
<?php echo $this->renderPartial('/back/menu',array('isNewRecord'=>false,'active'=>PeopleType::UNIT,'people_id'=>@$this->people->id,'type'=>@$this->people->type));?>
<?php
$columns =array(
    array(
        'class' => 'StyledCheckBoxColumn',
        'selectableRows' => 2,
        'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
    ),
    array(
        'name'=>'name',
        'type'=>'raw',
        'value'=>'CHtml::link($data->name,$data->url)',
        'filter'=>'',
    ),
);

if(in_array($this->people->type,array_keys(People::getTypeGroupLabels(People::LAW))))
    $columns[]=array(
        'header'=>'',
        'type'=>'raw',
        'value'=>'CHtml::link("Добавить сотрудника",Yii::app()->createUrl("/people/peopleStaff/create/", array("unit_id" => $data->id,"people_id" => '.@$this->people->id.')))',
        'filter'=>'',
    );

$columns[]=
    array(
        'header' => 'Действия',
        'class' => 'CButtonColumn',
        'template' => '{update}{delete}',
        'buttons' => array(
            'update' => array(
                'url' => 'Yii::app()->createUrl("/people/peopleUnit/update", array("id" => $data->id,"people_id" => '.@$this->people->id.'))',
            ),
        ),
    );

$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => false,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => $columns
));