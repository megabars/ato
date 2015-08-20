<?php
$this->breadcrumbs[] = 'Сотрудники';
?>

<div class="page-header">
    <h2>Сотрудники<?php echo ($this->people)?" - ".$this->people->full_name:""?></h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all"
       href="<?php echo $this->createUrl('/people/peopleStaff/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/people/peopleStaff/create',array('people_id'=>@$this->people->id,)); ?>">
        Добавить
    </a>
</div>
<?php echo $this->renderPartial('/back/menu',array('isNewRecord'=>false,'active'=>PeopleType::STAFF,'people_id'=>@$this->people->id,'type'=>@$this->people->type));?>
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
            'name'=>'photo',
            'type'=>'raw',
            'value'=>'($data->photo)?CHtml::image($data->getSmallUrl("photo")):""',
            'filter'=>'',
            'htmlOptions' => array('class' => 'photos'),
        ),
        'full_name',
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/people/peopleStaff/update", array("id" => $data->id,"people_id" => '.@$this->people->id.'))',
                ),
            ),
        ),
    ),
));