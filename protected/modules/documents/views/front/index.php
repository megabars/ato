<?php
/**
 * @var $this Controller
 * @var $types DocumentsFolder
 * @var $executives Executive
 * @var $documents Documents
 */

$this->pageTitle = 'Нормативно-правовые акты';

//$this->breadcrumbs = array(
//    'Документы',
//    'Нормативно-правовые акты'
//);
?>

<div class="wrap invalid-version">
    <h2>Нормативно-правовые акты</h2>
    <div class="clearfix">
        <div class="table-filter">

            <div class="grid-search">
                <?php $this->renderPartial('_search',array(
                    'model'=>$documents,
                    'types' => $types,
                    'executives' => $executives,
                    'documents' => $documents,
                )); ?>
            </div>

            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'docs-form',
                'dataProvider'=>$documents->searchNpa(),
                'cssFile' => false,
                'ajaxUpdate'=>true,
                'itemsCssClass' => 'table',
                'template' => '{items}{pager}',
                'columns'=>array(
                    array(
                        'header'=>'Дата',
                        'name'=>'date',
                        'type' => 'raw',
                        'value'=>'isset($data->date_real)?date("d.m.Y", $data->date_real):""',
                        'htmlOptions'=>array('class'=>'nowrap'),
                    ),
                    array(
                        'header'=>'Номер',
                        'name'=>'number',
                        'type' => 'raw',
                        'value'=>function ($documents) {
                            return '<div>№'. $documents->number .'</div>';
                        },
                    ),
                    array(
                        'header'=>'Название',
                        'name'=>'title',
                        'type' => 'raw',
                        'value' => function ($documents) {
                            return '<div class="link"><a href="/documents/front/view/id/'. $documents->id .'">' . $documents->title . '</a></div>';
                        },
                        'htmlOptions'=>array('class'=>'max500'),
                    ),
                    array(
                        'header'=>'Тип',
                        'name'=>'folder_id',
                        'type' => 'raw',
                        'value'=>'$data->folder->title',
                    ),
//                        array(
//                            'header'=>'Орган исполнительной власти',
//                            'name'=>'',
//                            'type' => 'raw',
//                            'value'=>'isset($documents->executive)?$documents->executive->name: "Администрация Томской области"',
//                        ),
                    array(
                        'name'=>'note',
                        'sortable' => false,
                        'headerHtmlOptions'=>array('class'=>'last'),
                    ),
                ),
                'pager'=>array(
                    'header'=>'',
                    'cssFile'=>false,
                    'firstPageLabel'=> '&larr;&nbsp;&nbsp;Первая',
                    'prevPageLabel'=>'&larr;&nbsp;&nbsp;Предыдущая',
                    'nextPageLabel'=>'Следующая&nbsp;&nbsp;&rarr;',
                    'lastPageLabel'=> 'Последняя&nbsp;&nbsp;&rarr;',
                ),
            )); ?>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#search-docs').submit(function(e){
            updateDocs();
            e.preventDefault();
        });

        $('#range-date input').on('change',function(){
            updateDocs();
        });

        $('#checked-types input').on('ifChanged',function(){
            updateDocs();
        });

        $('#checked-executives input').on('ifChanged',function(){
            updateDocs();
        });
    });
    function updateDocs(){

        var searchText = $('#search-docs').find('input[type="text"]').val();
        var types = [];
        var executives = [];
        var dateStart =  $('#range-date').find('#date_start').val();
        var dateEnd =  $('#range-date').find('#date_end').val();

        $('#checked-types li').each(function(){
            $(this).find('input').data('id');
            if($(this).find('input').is(':checked'))
                types.push($(this).find('input').data('id'));
        });

        $('#checked-executives li').each(function(){
            $(this).find('input').data('id');
            if($(this).find('input').is(':checked'))
                executives.push($(this).find('input').data('id'));
        });

        $.fn.yiiGridView.update('docs-form', {data: {
            "Documents": {
                folder_id: types,
                executive_id: executives,
                searchText: searchText,
                dateStart: dateStart,
                dateEnd: dateEnd
            }
        }});
    };

</script>