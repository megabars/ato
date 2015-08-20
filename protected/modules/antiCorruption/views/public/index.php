<?php
/** @var $model AcPublic */
/** @var $this PublicController */


$this->pageTitle = 'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера';

$this->breadcrumbs = array(
    'Противодействие коррупции' => '/antiCorruption/back',
    $this->pageTitle
);
?>

<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group">
    <a
        class="btn btn-warning icon icon-trash remove-all"
        data-grid-id="public-grid"
        href="<?php echo $this->createUrl('/antiCorruption/public/deleteAll'); ?>">Удалить выбранные</a>

    <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/antiCorruption/category/index'); ?>">
        Список категорий
    </a>

    <?php echo CHtml::ajaxLink('Добавить запись', $this->createUrl('/antiCorruption/public/save'), array(
        'success'=>'function(html){
                jQuery("#public_ajax_popup").html(html);
                $("#public_dialog").dialog("open");
            }',
    ), array(
        'id'=>'showPublicDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'public_dialog',
    'options'=>array(
        'title'=>'Добавить запись',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="public_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/antiCorruption/public',
    'id' => 'public-grid',
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
            'name' => 'fio'
        ),
        array(
            'name' => 'post'
        ),
        array(
            'name' => 'type',
            'type' => 'raw',
            'sortable' => true,
            'value' => '($data->type==1)?"Доход":"Расход"',
            'filter' => CHtml::activeDropDownList($model, 'type', array(''=>'Показать все', 0=>'Расход', 1=>'Доход')),
        ),
        array(
            'name' => 'year',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/public/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/antiCorruption/public/save", array("id" => $data->id))',
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
    $(document).on('click', '#public-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#public_ajax_popup').html(data);
                $("#public_dialog").dialog("open");
            }
        });
    });
</script>