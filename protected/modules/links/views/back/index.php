<?php
/** @var $this AdminController */
/** @var $record Links */

$this->breadcrumbs = array(
    'Карусель ссылок',
);

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
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

<div class="page-header">
    <h2>Карусель ссылок</h2>
</div>

<div class="list-group">

<?php echo CHtml::ajaxLink('Добавить ссылку', $this->createUrl('/links/back/save'), array(
    'data' => array('group_id' => $groupId),
    'success'=>'function(html){
                        jQuery("#links_ajax_popup").html(html);
                        $("#links_dialog").dialog("open");
                    }',
), array(
    'id'=>'showLinksDialogBtn',
    'class' => 'btn',
));
?>
    <a
        data-grid-id="links-grid"
        class="btn btn-warning icon icon-trash remove-all" href="/links/back/deleteAll">
        Удаление
    </a>

</div>
<?php
$model = new Links();
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
                'drag' => array(
                    'label'=>'',
                    'options'=>array(
                        'class' => 'drag',
                    )
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/links/back/save", array("id" => $data->id))',
                    'options'=>array(
                        'class' => 'update_button update',
                        'onclick' => 'return false;',
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
