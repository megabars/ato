<?php
/** @var $this AdminController */
/** @var $folder DocumentsFolder */
/** @var $folder DocumentsFolder */

$this->breadcrumbs = array(
    'Нормативно-правовые акты' => $this->createUrl('/documents/back'),
    $folder->title,
);
?>

    <div class="page-header">
        <h2><?php echo $folder->title; ?></h2>
    </div>
    <div class="list-group">
        <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/documents/file/deleteAll'); ?>">Удалить выбранные</a>

        <?php echo CHtml::ajaxLink('Добавить документ', $this->createUrl('/documents/file/save/folderId/'.$folder->id), array(
            'success'=>'function(html){
                jQuery("#file_ajax_popup").html(html);
                $("#file_dialog").dialog("open");
            }',
        ), array(
            'id'=>'showDocumentDialogBtn',
            'class' => 'btn fr',
        )); ?>
    </div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'file_dialog',
    'options'=>array(
        'title'=>'Добавить документ',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="file_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/documents/file/index/folderId/'.$folder->id,
    'id' => 'file-grid',
    'enableSorting' => true,
    'summaryText' => '',
    'ajaxUpdate' => true,
    'template' => "{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/documents/file/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/documents/file/save", array("id" => $data->id, "folderId" => '.$folder->id.'))',
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
                $("#file_dialog").dialog("open");
                $('#file_ajax_popup').html(data);
            }
        });
    });
</script>