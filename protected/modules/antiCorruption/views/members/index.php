<?php
/** @var $model AcMembers */
/** @var $this MembersController */


$this->pageTitle = 'Состав комиссии';

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
        data-grid-id="members-grid"
        href="<?php echo $this->createUrl('/antiCorruption/members/deleteAll'); ?>">Удалить выбранные</a>
    <?php echo CHtml::ajaxLink('Добавить запись', $this->createUrl('/antiCorruption/members/save'), array(
        'success'=>'function(html){
                jQuery("#members_ajax_popup").html(html);
                $("#members_dialog").dialog("open");
            }',
    ), array(
        'id'=>'showPublicDialogBtn',
        'class' => 'btn btn-sm icons white add-new fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'members_dialog',
    'options'=>array(
        'title'=>'Добавить запись',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="members_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/antiCorruption/members',
    'id' => 'members-grid',
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
            'name' => 'fio'
        ),
        array(
            'name' => 'post'
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/members/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/members/save", array("id" => $data->id))',
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
    $(document).on('click', '#members-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#members_ajax_popup').html(data);
                $("#members_dialog").dialog("open");
            }
        });
    });
</script>