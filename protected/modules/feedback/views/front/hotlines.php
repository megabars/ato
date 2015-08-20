<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Горячие линии';

$this->breadcrumbs = array(
    'Горячие линии'
);

?>

<div class="wrap">

    <h2 class="title-page">Горячие линии</h2>

    <div class="grid-search">
        <?php $this->renderPartial('_search', array('model' => $model)); ?>
    </div>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'hotlines-form',
        'dataProvider' => $model->search(),
        'cssFile' => FALSE,
        'ajaxUpdate' => TRUE,
        'itemsCssClass' => 'table jobs',
        'template' => '{items}{pager}',
        'columns' => array(
            array(
                'header' => 'Наименование',
                'name' => 'title',
                'type' => 'raw',
                'value' => '$data->name',
            ),
            array(
                'header' => 'Телефон',
                'name' => 'date',
                'type' => 'raw',
                'value' => '$data->phone',
                'headerHtmlOptions'=>array('class'=>'last'),
            ),
        ),
        'pager' => array(
            'header' => '',
            'cssFile' => FALSE,
            'firstPageLabel' => FALSE,
            'prevPageLabel' => '&larr;&nbsp;&nbsp;Предыдущая',
            'nextPageLabel' => 'Следующая&nbsp;&nbsp;&rarr;',
            'lastPageLabel' => FALSE,
        ),
    )); ?>
</div>