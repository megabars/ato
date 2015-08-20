
<?php
/** @var $model PageFacts */
/** @var $this PageFactsController */

$model = new VideoGalleryVideos('search');

if ($pageModel->video_id === null) {
    $pageModel->video_id = 0;
}

if (!isset($instanceType))
    $instanceType = 'StaticPage';

$this->widget('application.widgets.adminGridView', array(
    'id' => 'pageVideoGrid',
    'dataProvider' => $model->search(),
    'filter'=>$model,
//    'filter' => false,
    'enablePagination' => true,
    'enableSorting' => false,
    'ajaxUpdate' => true,
    'rowCssClassExpression' => '($data->id == '.$pageModel->video_id.') ? "used" : ""',
    'summaryText' => '',
    'htmlOptions' => array('class' => 'table'),
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'name' => 'title',
//            'value' => '"<a href=\"http://".$data->url."\" target=\"_blank\"> ".$data->executive->name."</a>"'
        ),
        array(
            'name' => 'date',
//            'value' => 'date("d-m-Y H:i", $data->date)',
            'sortable' => true,
            'filter' => false,
        ),
        array(
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => true,
            'filter' => false,
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{delete}<span class="selected" style="margin: 0 5px;">{use}</span>',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/pages/pageVideo/delete", array(
                            "id" => $data->id,
                            "pageId" => '.$pageModel->id.',
                            "instanceType" => "'.$instanceType.'"))'
                ),
                'use' => array(
                    'label' => 'Выбрать',
                    'url' => 'Yii::app()->createUrl("/pages/pageVideo/use", array(
                            "id" => $data->id,
                            "pageId" => '.$pageModel->id.',
                            "instanceType" => "'.$instanceType.'"))',
                    'options' => array('ajax' => array(
                        'type' => 'post',
                        'url'=>'js:$(this).attr("href")',
                        'success' => 'js:function(html){$.fn.yiiGridView.update("pageVideoGrid");}')),
                ),
            ),
        ),
    ),
));