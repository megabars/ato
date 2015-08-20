
<?php
/** @var $model Portal */
/** @var $this PortalController */

$this->breadcrumbs = array(
    'Настройка доступа',
);
?>

<div class="page-header">
    <h2>Настройка доступа</h2>
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
        array('name' => 'title'),
        array('name' => 'alias'),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/admin/main/staticPageAccessUpdate", array("id" => $data->id))',
                    'options' => array("target" => "_blank", 'class' => 'view'),
                ),
            ),
        ),
    ),
));