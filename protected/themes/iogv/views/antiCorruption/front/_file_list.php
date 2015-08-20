<?php
/**
 * @var $this FrontController
 * @var $model AcFile
 */
?>

<div class="left-content">

    <div class="table-filter">
        <?php $this->renderPartial('_search'); ?>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'ac-file-grid',
            'dataProvider'=>$model->search(),
            'cssFile' => false,
            'ajaxUpdate'=>true,
            'itemsCssClass' => 'table',
            'template' => '{items}{pager}',
            'columns'=>array(
                array(
                    'header'=>'Номер',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                    'htmlOptions'=>array(
                        'class'=>'max80'
                    )
                ),
                'title',
                array(
                    'header'=>'Документ',
                    'name'=>'file',
                    'type' => 'raw',
                    'value'=>function ($data) {
                        return '<div class="link">
                                        <a href="'.$data->getFileUrl($data->file).'">Скачать</a>
                                        <div class="file-simple">'.@$data->originFile->ext.' '.File::getFileSize($data->file, "Mb").'</div>
                                        </div>';
                    },
                    'htmlOptions'=>array(
                        'class'=>'last'
                    )
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
        $('#search').submit(function(event){
            $.fn.yiiGridView.update('ac-file-grid', {
                data: {AcFile: {title: $(this).find('input[type="text"]').val()}}
            });
            event.preventDefault();
        });
    });
</script>