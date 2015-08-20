
<?php
/** @var $model PageFacts */
/** @var $this PageFactsController */

?>

<div class="list-group">
    <?php
    echo CHtml::ajaxLink('Добавить', $this->createUrl('/pages/pageExecutives/create'), array(
        'data' => array('pageId' => $pageId),
        'success'=>'function(html){
                        jQuery("#executives_ajax_poupup").html(html);
                        $("#executives_dialog").dialog("open");
                    }',
    ), array(
        'class' => 'btn btn-light icon icon-plus-blue',
    ));
    ?>

    <a
        data-count-id="exec_count"
        data-grid-id="executivesGrid"
        class="btn btn-warning icon icon-trash remove-all"
        href="<?php echo $this->createUrl('/pages/pageExecutives/deleteAll'); ?>">
        Удаление
    </a>
</div>


<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'executives_dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Привязка к органу власти',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),

));
echo '<div id="executives_ajax_poupup" class="form"></div>';
$this->endWidget('zii.widgets.jui.CJuiDialog');

$model = new PageExecutives();
$model->page_id = $pageId;


$this->widget('application.widgets.adminGridView', array(
    'id' => 'executivesGrid',
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
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'executivesGrid-ids[]'),
        ),
        array(
            'type' => 'raw',
            'value' => '"<a href=\"http://".$data->url."\" target=\"_blank\"> ".@$data->executive->name."</a>"'
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/pages/pageExecutives/update", array("id" => $data->id))',
                    'options' => array(

                        'class' => 'view',
                        'ajax' => array(
                            'type' => 'get',
                            'url'=>'js:$(this).attr("href")',
                            'beforeSend' => 'js:console.log($(this).attr("href"))',
                            'success' => 'js:function(html){jQuery("#executives_ajax_poupup").html(html); $("#executives_dialog").dialog("open")}'
                        )
                    ),
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/pages/pageExecutives/delete", array("id" => $data->id))',
                ),
            ),
        ),
    ),
));