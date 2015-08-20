<?php
/** @var $model IeFile */
/** @var $this FileController */

$this->pageTitle = 'Реализация независимой оценки в Томской области';

$this->breadcrumbs = array(
    'Независимая оценка',
    $this->pageTitle
);
?>

<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group">
    <a
        class="btn btn-warning icon icon-trash remove-all"
        href="<?php echo $this->createUrl('/independentEvaluation/realization/deleteAll'); ?>">Удалить выбранные</a>

    <?php echo CHtml::ajaxLink('Добавить ссылку', $this->createUrl('/independentEvaluation/realization/save/'), array(
        'success'=>'function(html){
                jQuery("#realization_ajax_popup").html(html);
                $("#realization_dialog").dialog("open");
            }',
    ), array(
        'id'=>'showFileDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'realization_dialog',
    'options'=>array(
        'title'=>'Ссылка',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="realization_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/independentEvaluation/realization/',
    'id' => 'realization-grid',
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
            'name' => 'link',
            'type' => 'raw',
            'sortable' => true,
            'value' => 'isset($data->link)? CHtml::link("Перейти",$data->link) : ""'
        ),
        array(
            'name' => 'portal_group_id',
            'sortable' => true,
            'value' => 'isset($data->portal_group_id)? $data->portalGroup->name : ""'
        ),
        array(
            'name' => 'executive_id',
            'sortable' => true,
            'value' => 'isset($data->executive_id)? $data->executive->name : ""'
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/independentEvaluation/realization/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/independentEvaluation/realization/save", array("id" => $data->id))',
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
    $(document).on('click', '#realization-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $("#realization_dialog").dialog("open");
                $('#realization_ajax_popup').html(data);
            }
        });
    });
</script>