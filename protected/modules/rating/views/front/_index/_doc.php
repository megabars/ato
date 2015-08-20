<?php

if ($type == 1) {
    $columns = array(
        array(
            'header' => 'Наименование',
            'value' => '$data->getTitleWithLink()',
            'type' => 'html'
        ),

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
            'header' => 'Дата',
            'value' => '$data->dateFormat()',
            'type' => 'html'
        ),
        array(
            'header' => 'Наименование',
            'value' => '$data->getTitleWithLink()',
            'type' => 'html'
        ),
        array(
            'header' => 'Вложения',
            'value' => '$data->getFilesList()',
            'type' => 'html'
        ),
    );
}

elseif ($type == 4){
    $columns = array(
        array(
            'header' => 'Дата',
            'value' => '$data->dateFormat()',
            'type' => 'html'
        ),
        array(
            'header' => 'Наименование',
            'value' => '$data->getTitleWithLink()',
            'type' => 'html'
        ),
    );
}

else{
    $columns = array(
        array(
            'header' => 'Дата',
            'value' => '$data->dateFormat()',
            'type' => 'html'
        ),
        array(
            'header' => 'Наименование',
            'value' => '$data->getTitleWithLink()',
            'type' => 'html'
        ),
        array(
            'header' => 'Тип',
            'value' => '$data->getTypeName()',
            'type' => 'html'
        ),
    );
}

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'rating',
    'dataProvider' => $dataProvider->search(),
    'cssFile' => false,
    'itemsCssClass' => 'table',
    'template' => '{items}{pager}',
    'columns' => $columns,
    'pager'=>array(
        'header'=>'',
        'cssFile'=>false,
        'firstPageLabel'=> false,
        'prevPageLabel'=>'&larr;&nbsp;&nbsp;Предыдущая',
        'nextPageLabel'=>'Следующая&nbsp;&nbsp;&rarr;',
        'lastPageLabel'=> false,
    ),
));