<?php
/** @var $model AcFile */
/** @var $this FileController */
?>


<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group">
    <a
        class="btn btn-warning icon icon-trash remove-all"
        data-grid-id="file-grid"
        href="<?php echo $this->createUrl('/antiCorruption/file/deleteAll'); ?>">Удалить выбранные</a>

    <?php echo CHtml::ajaxLink('Добавить файл', $this->createUrl('/antiCorruption/file/save/type/'.$this->type), array(
        'success'=>'function(html){
                jQuery("#file_ajax_popup").html(html);
                $("#file_dialog").dialog("open");
            }',
    ), array(
        'id'=>'showFileDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>


<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'file_dialog',
    'options'=>array(
        'title'=>'Добавить файл',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="file_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/antiCorruption/file/index/type/'.$this->type,
    'id' => 'file-grid',
    'enableSorting' => true,
    'summaryText' => '',
    'ajaxUpdate' => true,
    'template' => "{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'file-grid-ids[]'),
        ),
        array(
            'name' => 'title',
        ),
        array(
            'name' => 'file',
            'type' => 'raw',
            'sortable' => false,
            'value' => 'CHtml::link("Скачать",array($data->getFileUrl(@$data->originFile->id)))',
            'filter' => false
        ),
        array(
            'header' => 'Загружено',
            'type' => 'raw',
            'sortable' => true,
            'value' => '@date("d.m.Y H:i", $data->originFile->date)'
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/file/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/file/save", array("id" => $data->id))',
                    'options'=>array(
                        'class' => 'update',
                        'onclick' => 'return false;',
                    )
                ),
            ),
        ),
    ),
)); ?>

<script type="text/javascript">
    $(document).on('click', '#file-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#file_ajax_popup').html(data);
                $("#file_dialog").dialog("open");
            }
        });
    });
</script>