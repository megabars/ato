<?php
/** @var $model AcFile */
/** @var $this FileController */

$this->pageTitle = 'Административное деление';
$this->breadcrumbs = array(
    $this->pageTitle
);
?>


<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group">
    <a
        class="btn btn-warning icon icon-trash remove-all"
        href="<?php echo $this->createUrl('/map/back/deleteAll'); ?>">Удалить выбранные</a>

    <?php echo CHtml::ajaxLink('Добавить запись', $this->createUrl('/map/back/save'), array(
        'success'=>'function(html){
                jQuery("#map_ajax_popup").html(html);
                $("#map_dialog").dialog("open");
            }',
    ), array(
        'id'=>'showFileDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>


<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'map_dialog',
    'options'=>array(
        'title'=>'Административный элемент',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="map_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/map/back/index',
    'id' => 'map-grid',
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
            'name' => 'name',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/map/back/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/map/back/save", array("id" => $data->id))',
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
    $(document).on('click', '#map-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#map_ajax_popup').html(data);
                $("#map_dialog").dialog("open");
            }
        });
    });
</script>