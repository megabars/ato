<?php

if ($type == 1) {
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
elseif ($type == 3){
    $columns = array(
        array(
            'header' => '№',
            'value' => '$row+1',
        ),
        'title'
    );
}

else{

    $columns = array(
        array(
            'header' => '№',
            'value' => '$row+1',
        ),
        'title',
        array(
            'header' => 'Тип',
            'value' => '$data->getTypeName()',
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