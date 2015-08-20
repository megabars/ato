<?php
/** @var $model AppealSchedule */
/** @var $this ScheduleController */
/** @var $grid string */


$this->pageTitle = 'График приема граждан';

$this->breadcrumbs = array(
    'Обращения граждан' => '/appeal/back',
    $this->pageTitle
);
?>

<h3 class="page-header"><?php echo $this->pageTitle; ?></h3>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/appeal/schedule/deleteAll'); ?>">Удалить выбранные</a>

    <?php echo CHtml::ajaxLink('Добавить', $this->createUrl('/appeal/schedule/save'), array(
        'success'=>'function(html){
            jQuery("#schedule_ajax_popup").html(html);
            $("#schedule_dialog").dialog("open");
        }',
    ), array(
        'id'=>'showExpertiseDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'schedule_dialog',
    'options'=>array(
        'title'=>'График приема',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="schedule_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->renderPartial($grid, array('model'=>$model));?>

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