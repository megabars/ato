
<?php
/** @var $model PeopleGroup */
/** @var $this PeopleGroupController */

$this->breadcrumbs = array(
    $this->pageTitle,
);
?>

<div class="page-header">
    <h2><?php echo $this->pageTitle?></h2>
</div>
<div class="list-group">
    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/people/peopleGroup/create'); ?>">
        Добавить
    </a>
</div>
<br>
<br>

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
            'name'=>'group_id',
            'type'=>'raw',
            'value'=>'@PeopleGroup::$labels[@$data->group_id]',
            'filter'=>PeopleGroup::$labels
        ),
        'title',
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}',
        ),
    ),
));