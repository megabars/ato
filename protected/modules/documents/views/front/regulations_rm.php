<?php
/**
// * @var $this Controller
 * @var $records DocumentsFolder[]
 */

$this->pageTitle = 'Административные регламенты';

$this->breadcrumbs = array(
    'Документы',
    'Административные регламенты'
);
?>

<div class="wrap">

    <h2>Административные регламенты</h2>

    <div class="table-filter">

        <div class="search">
            <?php
//            $this->renderPartial('_search',array(
//                'model'=>$list,
//            ));
            ?>
        </div>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'docs-form',
            'dataProvider'=>$list->search(),
            'cssFile' => false,
            'ajaxUpdate'=>true,
            'itemsCssClass' => 'table',
            'template' => '{items}{pager}',
            'columns'=>array(
                array(
                    'header'=>'Дата',
                    'name'=>'date',
                    'type' => 'raw',
                    'value'=>'date("d.m.Y", $data->date)',
                    'htmlOptions'=>array('class'=>'nowrap'),
                ),
                array(
                    'header'=>'Номер',
                    'name'=>'number',
                    'type' => 'raw',
                    'value'=>function ($list) {
                        echo '<div>'. $list->number .'</div>
                                <div class="link"><a href="/documents/front/view/id/'. $list->id .'">Перейти к документу</a></div>
                                <div class="link"><a href="">Скачать</a></div>';
                    },
                ),
                array(
                    'header'=>'Исполнительный орган государственной власти',
                    'type' => 'raw',
                    'value'=>function ($list) {
                        echo 'Департамент инвестиционного развития';
                    },
                ),
                array(
                    'header'=>'Название',
                    'name'=>'preview',
                    'type' => 'raw',
                    'htmlOptions'=>array('class'=>'max300'),
                ),
                array(
                    'header'=>'Тип',
                    'name'=>'folder_id',
                    'type' => 'raw',
                    'value'=>function ($list) {
                        echo @$list->folder->title;
                    }
                ),
                array(
                    'header'=>'Примечание ',
                    'type' => 'raw',
                    'value'=>function ($list) {
                        echo '';
                    },
                    'headerHtmlOptions'=>array('class'=>'last'),
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

<script>
    $(document).ready(function(){

        $('#search-docs').submit(function(e){
            updateDocs();
            e.preventDefault();
        });

        function updateDocs(){
            var nameDocs = $('#search-docs').find('input[type="text"]').val();

            $.ajax({
                url:'<?php echo Yii::app()->createUrl($this->route); ?>',
                type: 'post',
                data: {"Documents":{preview:nameDocs}},
                success:function(data){
                    $.fn.yiiGridView.update('docs-form');
                    nameDocs.length = 0;
                }
            });
        };
    });

</script>