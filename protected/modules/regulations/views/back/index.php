<?php
/** @var $this AdminController */
/** @var $model Regulation */

$this->breadcrumbs = array(
    'Административные регламенты',
);
?>

<div class="page-header">
    <h2>Административные регламенты</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/regulations/back/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/regulations/back/create'); ?>">
        Добавить документ
    </a>

    <?php

//    echo CHtml::ajaxLink('Добавить документ', $this->createUrl('/regulations/back/save/'), array(
//        'success'=>'function(html){
//                jQuery("#npa_ajax_popup").html(html);
//                $("#npa_dialog").dialog("open");
//            }',
//    ), array(
//        'class' => 'btn btn-sm icons white add-new fr',
//    ));

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


$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/regulations/back/index',
    'id' => 'npa-grid',
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
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/regulations/back/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/regulations/back/update", array("id" => $data->id))',
                    'options'=>array(
                        'class' => 'update',
                    )
                ),
            ),
        ),
    ),
)); ?>


<!--<script type="text/javascript">-->
<!--    $(document).on('click', '#npa-grid .update', function(){-->
<!--        $.ajax({-->
<!--            url: $(this).attr('href'),-->
<!--            type: 'post',-->
<!--            success: function(data) {-->
<!--                $("#npa_ajax_popup").html(data);-->
<!--                $("#npa_dialog").dialog("open");-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->