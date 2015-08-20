
<?php
/** @var $model PageFacts */
/** @var $this PageFactsController */

?>

<div class="list-group">
    <?php
    echo CHtml::ajaxLink('Добавить', $this->createUrl('/pages/pageFacts/create'), array(
        'data' => array('pageId' => $pageModel->id),
        'success'=>'function(html){
                        jQuery("#facts_ajax_poupup").html(html);
                        $("#facts_dialog").dialog("open");
                    }',
    ), array(
        'id'=>'showFactsDialog',
        'class' => 'btn btn-light icon icon-plus-blue',
    ));
    ?>

    <a
        data-count-id="facts_count"
        data-grid-id="factsGrid"
        class="btn btn-warning icon icon-trash remove-all"
        href="<?php echo $this->createUrl('/pages/pageFacts/deleteAll'); ?>">
        Удаление
    </a>
</div>


<?php
$model = new PageFacts();
$model->page_id = $pageModel->id;

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'facts_dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Создание факта',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),

));
echo '<div id="facts_ajax_poupup" class="form"></div>';
$this->endWidget('zii.widgets.jui.CJuiDialog');



$this->widget('application.widgets.adminGridView', array(
    'id' => 'factsGrid',
    'dataProvider' => $model->search(),
//    'filter' => false,
    'enablePagination' => true,
    'enableSorting' => false,
    'ajaxUpdate' => true,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'factsGrid-ids[]'),
        ),
        array('name' => 'text'),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/pages/pageFacts/update", array("id" => $data->id))',
                    'options' => array('ajax' => array(
                        'type' => 'get',
                        'url'=>'js:$(this).attr("href")',
                        'beforeSend' => 'js:console.log($(this).attr("href"))',
                        'success' => 'js:function(html){jQuery("#facts_ajax_poupup").html(html); $("#facts_dialog").dialog("open")}')),
                ),

                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/pages/pageFacts/delete", array("id" => $data->id))',
                ),
            ),
        ),
    ),
));