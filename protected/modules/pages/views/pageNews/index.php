<?php
/** @var $this AdminController */
/** @var $model News */

?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'news_dialog',
    'options'=>array(
        'title'=>'Добавить новость',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="news_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>


<div class="buttons">

<?php echo CHtml::ajaxLink('Добавить новость', $this->createUrl('/pages/pageNews/save'), array(
    'data' => array('type' => $type),
    'success'=>'function(html){
                        jQuery("#news_ajax_popup").html(html);
                        $("#news_dialog").dialog("open");
                    }',
), array(
    'id'=>'showNewsDialogBtn',
    'class' => 'btn btn-light icon icon-plus-blue',
)); ?>


    <a
        class="btn btn-warning icon icon-trash remove-all"
        data-count-id="news_count"
        data-grid-id="news-grid"
        href="<?php echo $this->createUrl('/news/back/deleteAll'); ?>">Удалить выбранные</a>
</div>

<div class="grid">

<?php $model = new News();
$model->unsetAttributes();
$model->type = $type;
$model->limit = (!empty($limit) && $limit)? $limit : false;

$this->widget('application.widgets.sortableGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/pages/pageNews/gridUpdate/type/'.$model->type,
    'id' => 'news-grid',
    'enableSorting' => true,
    'summaryText' => '',
    'ajaxUpdate' => true,
    'template' => "{items}{pager}",
    'sortUrl' => '/pages/pageNews/sort',
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'name' => 'date',
            'value' => 'date("d-m-Y H:i", strtotime($data->date))',
            'sortable' => true,
        ),
        array(
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => false,
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{delete}{update}{drag}{view}',
            'htmlOptions' => array(
                'class' => 'CButtonColumn'
            ),
            'afterDelete'=>'function(link,success,data){
                if(success) {
                    var count = (parseInt(data)>0)? "("+data+")" : "(пусто)";
                    $("#news_count").text(count);
                }
             }',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/pages/pageNews/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/pages/pageNews/save", array("id" => $data->id))',
                    'options'=>array(
                        'class' => 'update',
                        'onclick' => 'return false;',
                    )
                ),
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/news/front/view", array("id" => $data->id))',
                    'options' => array("target" => "_blank", 'class'=> 'view'),
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

    <div class="center">
        <a href="#" onclick="$.fn.yiiGridView.update('news-grid'); $(this).hide(); return false" class="link link-dotted show-all">Показать все</a>
    </div>
</div>


<script type="text/javascript">
    $(document).on('click', '#news-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#news_ajax_popup').html(data);
                $("#news_dialog").dialog("open");
            }
        });
    });
</script>