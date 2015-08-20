<?php
/** @var $model AcDocument */
/** @var $this DocumentController */


$this->pageTitle = 'Нормативно-правовые акты';

$this->breadcrumbs = array(
    'Противодействие коррупции' => '/antiCorruption/back',
    $this->pageTitle
);
?>

<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group">
    <a
        class="btn btn-warning icon icon-trash remove-all"
        data-grid-id="document-grid"
        href="<?php echo $this->createUrl('/antiCorruption/document/deleteAll'); ?>">Удалить выбранные</a>

    <?php echo CHtml::ajaxLink('Добавить документ', $this->createUrl('/antiCorruption/document/save'), array(
        'success'=>'function(html){
                jQuery("#document_ajax_popup").html(html);
                $("#document_dialog").dialog("open");
            }',
    ), array(
        'id'=>'showDocumentDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'document_dialog',
    'options'=>array(
        'title'=>'Добавить документ',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="document_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/antiCorruption/document',
    'id' => 'document-grid',
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
            'name' => 'title'
        ),
        array(
            'header' => 'Тип',
            'type' => 'raw',
            'sortable' => true,
            'value' => '$data->category->name'
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
                    'url' => 'Yii::app()->createUrl("/antiCorruption/document/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/document/save", array("id" => $data->id))',
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
    $(document).on('click', '#document-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#document_ajax_popup').html(data);
                $("#document_dialog").dialog("open");
            }
        });
    });
</script>