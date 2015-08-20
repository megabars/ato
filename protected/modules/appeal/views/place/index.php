<?php
/** @var $model AppealPlace */
/** @var $this PlaceController */


$this->pageTitle = 'Место, время и порядок приема';

$this->breadcrumbs = array(
    'Обращения граждан' => '/appeal/back',
    $this->pageTitle
);
?>

<h3 class="page-header"><?php echo $this->pageTitle; ?></h3>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/appeal/place/deleteAll'); ?>">Удалить выбранные</a>
    <?php echo CHtml::ajaxLink('Добавить', $this->createUrl('/appeal/place/save'), array(
        'success'=>'function(html){
            jQuery("#place_ajax_popup").html(html);
            $("#place_dialog").dialog("open");
        }',
    ), array(
        'id'=>'showExpertiseDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'place_dialog',
    'options'=>array(
        'title'=>'График приема',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="place_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/appeal/place',
    'id' => 'place-grid',
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
        'department',
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/appeal/place/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/appeal/place/save", array("id" => $data->id))',
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
    $(document).on('click', '#place-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#place_ajax_popup').html(data);
                $("#place_dialog").dialog("open");
            }
        });
    });
</script>