<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'ac-expertise-grid',
    'dataProvider'=>$records,
    'ajaxUpdate' => false,
    'itemsCssClass' => 'someCssClass',
    'emptyText' => '<h4>Не найдено мероприятий на выбранную дату</h4>',
    'template' => '{items}{pager}',
    'columns'=>array(
        array(
            'name'=>'date',
            'header'=>'ДАТА',
            'type' => 'raw',
            'value' => 'Rudate::date(date("d F, H:i", $data->date))',
        ),
        array(
            'name'=>'place',
            'header'=>'Место проведения',
            'type' => 'raw',
            'value' => '"<span>".$data->place."</span>"',
        ),
        array(
            'name'=>'title',
            'header'=>'Мероприятие',
            'type' => 'raw',
            'value' => '"<span>".CHtml::link($data->title,Yii::app()->createUrl("/afisha/front/view", array("id" => $data->id)))."</span>"',
        ),
        array(
            'name'=>'organizer',
            'header'=>'Организатор',
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

<?php
//// по мотивам DPRIDSP-296
//$tableData = array();
//$data = $records->getData();
//
//if ($data)
//    foreach ($data as $item) {
//        if ($item->date < time() && $type != 'day')
//            continue;
//
//        $tableData[] = $item;
//    }
//
//if(count($tableData) > 0): ?>
<!---->
<!--    <table>-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Дата</th>-->
<!--            <th>Место проведения</th>-->
<!--            <th>Мероприятие</th>-->
<!--            <th>Организатор</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php //foreach($tableData as $item):?>
<!--            <tr>-->
<!--                <td>--><?php //echo Rudate::date(date('d F, H:i', $item->date)); ?><!--</td>-->
<!--                <td><span>--><?php //echo $item->place; ?><!--</span></td>-->
<!--                <td>-->
<!--                        <span>-->
<!--                            <a href="--><?php //echo Yii::app()->createUrl('/afisha/front/view', array('id' => $item->id)); ?><!--">--><?php //echo $item->title; ?><!--</a>-->
<!--                        </span>-->
<!--                </td>-->
<!--                <td>--><?php //echo $item->organizer; ?><!--</td>-->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->
<!---->
<?php //else: ?>
<!--    <h4>--><?php //echo Yii::t('app', 'Не найдено мероприятий на выбранную дату' )?><!--</h4>-->
<?php //endif; ?>

