<?php
/** @var $this AdminController */
/** @var $record Faqs */

$this->breadcrumbs = array(
    'Часто задаваемые вопросы',
);
?>

<div class="page-header">
    <h2>Часто задаваемые вопросы</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/faqs/back/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/faqs/back/create'); ?>">
        Создать вопрос
    </a>
</div>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
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
            'name' => 'question',
            'sortable' => true,
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{up}{down}{update}{delete}',
            'buttons' => array(
                'up' => array(
                    'label' => 'вверх',
                    'imageUrl' => $this->assetsBase . '/images/up.jpg',
                    'url' => 'Yii::app()->createUrl("/faqs/back/order", array("id" => $data->id, "action" => "up"))',
                ),
                'down' => array(
                    'label' => 'вниз',
                    'imageUrl' => $this->assetsBase . '/images/down.jpg',
                    'url' => 'Yii::app()->createUrl("/faqs/back/order", array("id" => $data->id, "action" => "down"))',
                ),
            ),
        ),
    ),
));