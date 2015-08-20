<?php
/** @var $this AdminController */
/** @var $model DocumentsFolder */

$this->breadcrumbs = array(
    'Нормативно-правовые акты',
);

$groupId = $group->id
?>

<div class="page-header">
    <h2>Нормативно-правовые акты</h2>
<!--    <h2>--><?php //echo $group->name ?><!--</h2>-->
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/documents/back/deleteAll'); ?>">
        Удаление
    </a>

    <?php

    echo CHtml::ajaxLink('Добавить документ', $this->createUrl('/documents/npa/save/groupId/'.$groupId), array(
        'success'=>'function(html){
                jQuery("#npa_ajax_popup").html(html);
                $("#npa_dialog").dialog("open");
            }',
    ), array(
        'class' => 'btn btn-sm icons white add-new fr',
    ));

    echo CHtml::ajaxLink('Добавить тип', $this->createUrl('/documents/back/create'), array(
        'data' => array('group_id' => $groupId),
        'success'=>'function(html){
                jQuery("#folder_ajax_popup").html(html);
                $("#folder_dialog").dialog("open");
            }',
    ), array(
        'class' => 'btn btn-sm icons white add-new fr',
    ));
    ?>


</div>

<?php

/**
 * Диалог добавления документа, контент тянется аяксом
 */
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'npa_dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Добавить документ',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),
));
echo '<div id="npa_ajax_popup" class="form"></div>';
$this->endWidget('zii.widgets.jui.CJuiDialog');


/**
 * диалог добавления папки(группы документов), контент тянется аяксом
 */
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'folder_dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Добавить тип',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),
));
echo '<div id="folder_ajax_popup" class="form"></div>';
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
            'header' => 'Тип документа',
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => true,
            'filter' => false,
        ),
        array(
            'name' => 'id',
            'sortable' => false,
            'filter' => false,
            'header' => '',
            'type' => 'html',
            'value' => 'CHtml::link("Список файлов", Yii::app()->createUrl("/documents/npa/index", array("folderId" => $data->id)))',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/documents/back/update", array("id" => $data->id))',
                    'options' => array(
                        'class' => 'update',
                        'onclick' => 'return false;',
                    ),
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
            type: 'post',
            success: function(data) {
                $("#folder_ajax_popup").html(data);
                $("#folder_dialog").dialog("open");
            }
        });
    });
</script>