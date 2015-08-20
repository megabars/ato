<?php
/** @var $model AcExpertise */
/** @var $this ExpertiseController */


$this->pageTitle = 'Независимая антикоррупциионная экспертиза';

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
        data-grid-id="expertise-grid"
        href="<?php echo $this->createUrl('/antiCorruption/expertise/deleteAll'); ?>">Удалить выбранные</a>

    <?php echo CHtml::ajaxLink('Добавить проект', $this->createUrl('/antiCorruption/expertise/save'), array(
        'success'=>'function(html){
                jQuery("#expertise_ajax_popup").html(html);
                $("#expertise_dialog").dialog("open");
            }',
    ), array(
        'id'=>'showExpertiseDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'expertise_dialog',
    'options'=>array(
        'title'=>'Добавить проект',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="expertise_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/antiCorruption/expertise',
    'id' => 'expertise-grid',
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
        ),
        array(
            'name' => 'executive_id',
            'type' => 'raw',
            'sortable' => true,
            'value' => '@Portal::model()->findByPk($data->portal_id)->title'
        ),
        array(
            'name' => 'date_start',
            'type' => 'raw',
            'sortable' => true,
            'value' => '@date("d.m.Y H:i", $data->date_start)',
            'filter' => false,
        ),
        array(
            'name' => 'date_finish',
            'type' => 'raw',
            'sortable' => true,
            'value' => '@date("d.m.Y H:i", $data->date_finish)',
            'filter' => false,
        ),
        array(
            'name' => 'date_publish',
            'type' => 'raw',
            'sortable' => true,
            'value' => '@date("d.m.Y H:i", $data->date_publish)',
            'filter' => false,
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/expertise/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/expertise/save", array("id" => $data->id))',
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
    $(document).on('click', '#expertise-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#expertise_ajax_popup').html(data);
                $("#expertise_dialog").dialog("open");
            }
        });
    });
</script>