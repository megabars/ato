<?php
/**
 * @var $this Controller
 * @var $records Experts
 */
$this->pageTitle = 'Протоколы заседаний, заключения';

$this->breadcrumbs = array(
    $this->pageTitle
);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>


    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'experts-form',
        'dataProvider'=>$model->search(),
        'cssFile' => false,
        'enableSorting' => false,
        'ajaxUpdate'=>true,
        'itemsCssClass' => 'table',
        'template' => '{items}{pager}',
        'columns'=>array(
            array('name' => 'type'),
            array('name' => 'date'),
            array('name' => 'number'),
            array(
                'name' => 'expertsHelperIds',
                'type' => 'raw',
                'value' => '$data->getAuthorsString()',
                'filter' => CHtml::listData(ExpertsHelper::model()->findAll(), 'id', 'name')
            ),
            array('name' => 'descr'),

            array(
                'name' => 'file_id',
                'type' => 'raw',
                'value' => '($data->file_id) ? CHtml::link("Скачать", Yii::app()->controller->createUrl("/files/front/download", array("id" => @$data->file_id)), array("target" => "_blank")) :  ""'
            ),

        ),
        'pager'=>array(
            'header'=>'',
            'cssFile'=>false,
            'firstPageLabel'=> false,
            'prevPageLabel'=>'&larr;&nbsp;&nbsp;Предыдущая',
            'nextPageLabel'=>'Следующая&nbsp;&nbsp;&rarr;',
            'lastPageLabel'=> false,
        ),
    )); ?>
</div>