<?php
/** @var $model AcSchedule */
/** @var $this ScheduleController */


$this->pageTitle = 'План работ комиссии';

$this->breadcrumbs = array(
    'Противодействие коррупции' => '/antiCorruption/back',
    'Комиссия Администрации Томской области по соблюдению требований к служебному поведению' => '/antiCorruption/commission',
    $this->pageTitle
);
?>

<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group">
    <a
        class="btn btn-warning icon icon-trash remove-all"
        data-grid-id="schedule-grid"
        href="<?php echo $this->createUrl('/antiCorruption/schedule/deleteAll'); ?>">Удалить выбранные</a>
    <?php echo CHtml::ajaxLink('Добавить запись', $this->createUrl('/antiCorruption/schedule/save'), array(
        'success'=>'function(html){
                jQuery("#schedule_ajax_popup").html(html);
                $("#schedule_dialog").dialog("open");
            }',
    ), array(
        'id'=>'showPublicDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'schedule_dialog',
    'options'=>array(
        'title'=>'Добавить запись',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="schedule_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/antiCorruption/schedule',
    'id' => 'schedule-grid',
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
            'name' => 'date',
            'type' => 'raw',
            'sortable' => true,
            'value' => 'date("d.m.Y", $data->date)'
        ),
        array(
            'name' => 'description',
            'type' => 'raw',
            'sortable' => true,
            'value' => '$data->description'
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/schedule/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/schedule/save", array("id" => $data->id))',
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
    $(document).on('click', '#schedule-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#schedule_ajax_popup').html(data);
                $("#schedule_dialog").dialog("open");
            }
        });
    });
</script>