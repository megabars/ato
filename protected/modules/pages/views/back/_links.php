<?php
/** @var $this AdminController */
/** @var $record Links */

?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'links_dialog',
    'options'=>array(
        'title'=>'Создание ссылки',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),
)); ?>
<div id="links_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<div class="buttons">
    <?php echo CHtml::ajaxLink('Добавить ссылку', $this->createUrl('/links/back/save'), array(
        'data' => array('group_id' => $groupId),
        'success'=>'function(html){
                        jQuery("#links_ajax_popup").html(html);
                        $("#links_dialog").dialog("open");
                    }',
    ), array(
        'id'=>'showLinksDialogBtn',
        'class' => 'btn btn-light icon icon-plus-blue',
    )); ?>

    <a
        class="btn btn-warning icon icon-trash remove-all"
        data-count-id="links_count"
        data-grid-id="links-grid"
        href="<?php echo $this->createUrl('/links/back/deleteAll'); ?>">Удалить выбранные</a>
</div>


<div class="grid">
<?php $model = new Links();
$model->group_id = $groupId;
if(!empty($limit) && $limit)
    $model->limit = $limit;

$this->widget('application.widgets.sortableGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/links/back/gridUpdate/groupId/'.$model->group_id,
    'id' => 'links-grid',
    'enableSorting' => true,
    'summaryText' => '',
    'ajaxUpdate' => true,
    'template' => "{items}{pager}",
    'sortUrl' => '/links/back/sort',
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'links-grid-ids[]'),
        ),
        array(
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'name' => 'url',
            'sortable' => false,
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{delete}{update}{drag}',
            'htmlOptions' => array(
                'class' => 'CButtonColumn'
            ),
            'afterDelete'=>'function(link,success,data){
                if(success) {
                    var count = (parseInt(data)>0)? "("+data+")" : "(пусто)";
                    $("#links_count").text(count);
                }
             }',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/links/back/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/links/back/save", array("id" => $data->id))',
                    'options'=>array(
                        'class' => 'update',
                        'onclick' => 'return false;',
                    )
                ),
                'drag' => array(
                    'label'=>'',
                    'options'=>array(
                        'class' => 'drag',
                    )
                ),
            ),
        ),
    ),
)); ?>

<script type="text/javascript">
    $(document).on('click', '#links-grid .update_button', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $("#links_dialog").dialog("open");
                $('#links_ajax_popup').html(data);
            }
        });
    });
</script>
    <div class="center">
        <a href="#" onclick="$.fn.yiiGridView.update('links-grid'); $(this).hide(); return false" class="link link-dotted show-all">Показать все</a>
    </div>
</div>
