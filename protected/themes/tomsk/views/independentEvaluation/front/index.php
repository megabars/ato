<?php
/**
 * @var $this FrontController
 * @var $model IeFile
 */
$this->pageTitle = DocumentType::instance()->list[$model->file_type];

$this->breadcrumbs = array(
    'Независимая оценка'=>'/nezavisimaya_otsenka',
    $this->pageTitle
);
?>

<div class="wrap invalid-version">
    <h2><?php echo $this->pageTitle; ?></h2>
    <div class="clearfix">

        <?php $this->renderPartial('_menu'); ?>

        <div class="left-content">

            <div class="table-filter">
                <div class="grid-search">
                    <form class="search-min clearfix" id="search">
                        <button type="submit" class="btn-default">Искать</button>
                        <div>
                            <input type="text"/>
                        </div>
                </div>
            </div>

            <?php $columns =[];

                if($model->file_type != DocumentType::RESULT) {
                    array_push($columns, array(
                        'header'=>'Номер',
                        'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                        'htmlOptions'=>array(
                            'class'=>'max80'
                        )
                    ));
                }
                if($model->file_type == DocumentType::SUPPORT || $model->file_type == DocumentType::RESULT){
                    array_push($columns, array(
                        'name'=>'date',
                    ));
                }

                array_push($columns, 'title');

                if($model->file_type == DocumentType::RECOMMENDATION || $model->file_type == DocumentType::SUPPORT) {
                    array_push($columns, array(
                        'name'=>'description',
                        'type' => 'raw',
                    ));
                }

                if($model->file_type == DocumentType::REASON) {
                    array_push($columns, array(
                        'name'=>'doc_type',
                        'value'=>'$data->docType->name',
                    ));
                }

                array_push($columns, array(
                    'header'=>'Документ',
                    'name'=>'file',
                    'type' => 'raw',
                    'value'=>function ($data) {
                        return '<div class="link">
                                        <a href="'.$data->getFileUrl($data->file).'">Скачать</a>
                                        <div class="file-simple">'.$data->originFile->ext.' '.File::getFileSize($data->file, "Mb").'</div>
                                        </div>';
                    },
                    'htmlOptions'=>array(
                        'class'=>'last'
                    )
                ));
                ?>

                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'ie-file-grid',
                    'dataProvider'=>$model->search(),
                    'cssFile' => false,
                    'ajaxUpdate'=>true,
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
                )); ?>

            </div>
        </div>

        <script>
            $(document).ready(function(){
                $('#search').submit(function(event){
                    $.fn.yiiGridView.update('ie-file-grid', {
                        data: {IeFile: {
                            title: $(this).find('input[type="text"]').val()
                        }}
                    });
                    event.preventDefault();
                });
            });
        </script>
    </div>
</div>