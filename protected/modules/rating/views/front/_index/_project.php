<?php

if ($type == 5) {
    $columns = array(
        array(
            'header' => 'Дата размещения',
            'value' => '$data->dateFormat()',
            'type' => 'html'
        ),
        array(
            'header' => 'Наименование проекта нормативного правового акта',
            'value' => '$data->title',
        ),
        'author',
        array(
            'header' => 'Вложения',
            'value' => '$data->getFilesList()',
            'type' => 'html'
        ),
    );
}
if ($type == 6) {
    $columns = array(
        array(
            'header' => 'Дата размещения',
            'value' => '$data->dateFormat()',
            'type' => 'html'
        ),
        array(
            'header' => 'Разработчик или иной субъект нормотворческой деятельности',
            'value' => '$data->title',
            'type' => 'html'
        ),

        'title',
        array(
            'header' => 'Вложения',
            'value' => '$data->getFilesList()',
            'type' => 'html'
        ),
    );
}

else{
    $columns = array(
        array(
            'header' => 'Дата размещения',
            'value' => '$data->dateFormat()',
            'type' => 'html'
        ),
        array(
            'header' => 'Наименование нормативного правового акта',
            'value' => '$data->title',
            'type' => 'html'
        ),

        'title',
        array(
            'header' => 'Вложения',
            'value' => '$data->getFilesList()',
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