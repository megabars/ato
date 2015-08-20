<?php
/** @var $this AdminController */
/** @var $model DocumentsFolder */

?>
    <div class="list-group">
        <?php

        echo CHtml::ajaxLink('Добавить документ', $this->createUrl('/pages/PageDocFiles/create'), array(
            'data' => array('group_id' => $groupId),
            'success'=>'function(html){
                        jQuery("#file_ajax_poupup").html(html);
                        $("#file_dialog").dialog("open");
                    }',

        ), array(
            'class' => 'btn btn-light icon icon-plus-blue',
        ));

        echo CHtml::ajaxLink('Добавить папку', $this->createUrl('/pages/PageDocuments/create'), array(
            'data' => array('group_id' => $groupId),
            'success'=>'function(html){
                        jQuery("#folder_ajax_poupup").html(html);
                        $("#folder_dialog").dialog("open");
                    }',
        ), array(
            'class' => 'btn btn-light icon icon-plus-blue',
        ));

        ?>
        <a
            data-count-id="files_count"
            data-grid-id="folders-grid"
            class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/pages/PageDocuments/deleteAll'); ?>">
            Удалить выбранные
        </a>


    </div>

<?php

/**
 * Диалог добавления документа, контент тянется аяксом
 */
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'file_dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Добавить документ',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',

    ),
));
echo '<div id="file_ajax_poupup" class="form"></div>';
$this->endWidget('zii.widgets.jui.CJuiDialog');


/**
 * диалог добавления папки(группы документов), контент тянется аяксом
 */
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'folder_dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Добавить папку',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),
));
echo '<div id="folder_ajax_poupup" class="form"></div>';
$this->endWidget('zii.widgets.jui.CJuiDialog');


// такое бывает, если рендерить въюху не из своего контроллера
if (!isset($model)) {
    $model = new DocumentsFolder();
    $model->group_id = $groupId;
}


/**
 * грид с папками конгретоной группы
 */
$this->widget('application.widgets.adminGridView', array(
    'id' =>'folders-grid',
    'dataProvider' => $model->search(),
//    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => true,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'folders-grid-ids[]'),
        ),
        array(
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/pages/PageDocuments/update", array("id" => $data->id))',
                    'options' => array(
                        'class' => 'update',
                        'onclick' => 'return false;',
                    ),
                ),
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/pages/PageDocFiles/index", array("folderId" => $data->id))',
                    'options' => array(
                        'class' => 'view',
                        'onclick' => 'return false;',
                    ),
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/pages/PageDocuments/delete", array("id" => $data->id))',
                ),
//                'view' => array(
//                    'url' => 'Yii::app()->createUrl("/documents/front/view", array("id" => $data->id))',
//                    'options' => array("target" => "_blank"),
//                ),
//                'up' => array(
//                    'label' => 'вверх',
//                    'imageUrl' => $this->assetsBase . '/images/up.jpg',
//                    'url' => 'Yii::app()->createUrl("/documents/back/order", array("id" => $data->id, "action" => "up"))',
//                    'options' => array('ajax' => array(
//                        'type' => 'get',
//                        'url'=>'js:$(this).attr("href")',
//                        'success' => 'js:function(html) {$.fn.yiiGridView.update("folders-grid");}'
//                    )),
//
//                ),
//                'down' => array(
//                    'label' => 'вниз',
//                    'imageUrl' => $this->assetsBase . '/images/down.jpg',
//                    'url' => 'Yii::app()->createUrl("/documents/back/order", array("id" => $data->id, "action" => "down"))',
//                    'options' => array('ajax' => array(
//                        'type' => 'get',
//                        'url'=>'js:$(this).attr("href")',
//                        'success' => 'js:function(html) {$.fn.yiiGridView.update("folders-grid");}'
//                    )),
//                ),
            ),
        ),
    ),
));
?>

<script type="text/javascript">
    $(document).on('click', '#folders-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'get',
            success: function(data) {
                $("#folder_ajax_poupup").html(data);
                $("#folder_dialog").dialog("open");
            }
        });
    });
    $(document).on('click', '#folders-grid .view', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'get',
            success: function(data) {
                $("#file_ajax_poupup").html(data);
                $("#file_dialog").dialog("open");
            }
        });
    });
</script>