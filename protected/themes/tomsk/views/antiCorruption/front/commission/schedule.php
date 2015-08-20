<?php
/**
 * @var $this FrontController
 * @var $model AcSchedule
 * @var $years array
 */

$this->pageTitle = 'План работы';

$this->breadcrumbs = array(
    'Противодействие коррупции',
    'Комиссия Администрации Томской области по соблюдению требований к служебному поведению'=>'/antiCorruption/front/commission',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>План работы</h2>
    <div class="clearfix">

        <?php $this->renderPartial('commission/_menu'); ?>

        <div class="left-content">

<!--            <div class="select-filter">-->
<!--                Показать данные за-->
<!--                <select class="select" name="year" id="year">-->
<!--                    <script>-->
<!--                        var myDate = new Date();-->
<!--                        var year = myDate.getFullYear();-->
<!--                        for(var i = 2010; i <= year+1; i++){-->
<!--                            document.write('<option value="'+i+'">'+i+'</option>');-->
<!--                        }-->
<!--                    </script>-->
<!--                </select>-->
<!--            </div>-->

            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'ac-schedule-grid',
                'dataProvider'=>$model->search(),
                'cssFile' => false,
                'ajaxUpdate'=>true,
                'itemsCssClass' => 'table',
                'template' => '{items}{pager}',
                'columns'=>array(
                    array(
                        'name' => 'date',
                        'type' => 'raw',
                        'value' => function($data) {
                            return Rudate::date(date('d F Y', $data->date)).' г.';
                        },
                        'htmlOptions'=>array(
                            'class'=>'nowrap'
                        )
                    ),
                    array(
                        'name'=>'description',
                        'type' => 'raw',
                        'sortable' => false
                    ),
                    array(
                        'header' => 'Документ',
                        'name' => 'file',
                        'type' => 'raw',
                        'value' => '$data->file ? CHtml::link("Скачать", File::model()->getFileUrl($data->file)) : ""',
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
    </div>
</div>
<script>
//    $(document).ready(function(){
//        $('.select').selecter('destroy');
//        $('.select').selecter({
//            callback: function (value, index) {
//                $.fn.yiiGridView.update('ac-schedule-grid', {
//                    data: {AcSchedule: {year: value}}
//                });
//            }
//        });
//    });
</script>

