<?php
/** @var $this AdminController */
/** @var $model Contact */

?>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all" href="<?php echo $this->createUrl('/contact/details/deleteAll'); ?>">
        Удалить выбранные
    </a>
    <a class="btn btn-sm icons white add-new fr" href="<?php echo Yii::app()->createUrl("/contact/details/loadForm"); ?>" onclick="loadForm($(this).attr('href')); return false;">
        Добавить контактные данные
    </a>
</div>

<script>
    function loadForm(url) {
        $(".ui-dialog-content").dialog("close");
        $.ajax({
            type:"post",
            data: {contact_id: <?php echo $_GET['id']; ?>},
            url:url,
            success: function(data){
                $("#contact_details_dialog").html(data).dialog("open");
            },
            error: function() {
                alert("Ошибка на сервере")
            }
        });
    }
</script>

<?php $this->widget('zii.widgets.jui.CJuiDialog',array('id'=>'contact_details_dialog', 'options'=>array(
    'title'=>'Добавить контакт',
    'autoOpen'=>false,
    'open' => 'js:function(){overlayShow()}',
    'close'=>'js:function(){overlayHide()}',
))); ?>

<?php
$this->widget('application.widgets.adminGridView', array(
    'id' => 'contact_details',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => true,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'name' => 'type',
            'value' => 'ContactType::instance()->list[$data->type]',
            'filter' => ContactType::instance()->list,
            'sortable' => false,
        ),
        array(
            'name' => 'value',
            'sortable' => true,
        ),
        array(
            'name' => 'description',
            'sortable' => true,
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/contact/details/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'click' => 'js:function(){
                        loadForm($(this).attr("href"));
                        return false;
                    }',
                    'url' => 'Yii::app()->createUrl("/contact/details/loadForm", array("id" => $data->id))',
                )
            ),
        ),
    ),
));