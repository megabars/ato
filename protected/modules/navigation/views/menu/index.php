
<?php
/** @var $model NavMenu */
/** @var $this MenuController */

$this->breadcrumbs = array(
//    'Навигация' => $this->createUrl('/navigation/back/index'),
	'Управление меню',
);
?>

<div class="page-header">
    <h2>Управление меню</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/navigation/menu/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn fr"
       href="<?php echo $this->createUrl('/navigation/menu/create'); ?>">
        Добавить меню
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
//        'name',
        array(
            'name' => 'alias',
            'value' => '@NavMenu::$aliases[$data->alias]',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{view}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/navigation/back", array("id" => $data->id))',
////                    'options' => array("target" => "_blank"),
                ),
            ),
        ),
    ),
));