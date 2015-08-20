<?php

if ($type == 5) {
    $columns = array(
        array(
            'header' => '№',
            'value' => '$row+1',
        ),
        'title',

        array(
            'header' => 'Номер и дата принятия',
            'value' => '$data->info',
            'type' => 'html'
        ),
        array(
            'header' => 'Тип',
            'value' => '$data->getTypeName()',
            'type' => 'html'
        ),
    );
}
else{

    $columns = array(
        array(
            'header' => '№',
            'value' => '$row+1',
        ),
        array(
            'header' => 'Дата размещения',
            'value' => '$data->dateFormat()',
            'type' => 'html'
        ),
        array(
            'header' => 'Автор',
            'value' => '$data->author',
            'type' => 'html'
        ),
        array(
            'header' => 'Вложения',
            'value' => '$data->getFilesList()',
            'type' => 'html'
        ),
    );
}
$columns[] = array(
    'header' => '',
    'class' => 'CButtonColumn',
    'template' => '{update}{delete}',
    'buttons' => array(
        'update' => array(
            'url' => 'Yii::app()->createUrl("/rating/back/update", array("id" => $data->id, "type" => '.$type.'))',
        ),
        'delete' => array(
            'url' => 'Yii::app()->createUrl("/rating/back/delete", array("id" => $data->id, "type" => '.$type.'))',
        ),
    ),
);

$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'enablePagination' => true,
    'enableSorting' => true,
    'template' => "{items}{pager}",
    'columns' => $columns
));