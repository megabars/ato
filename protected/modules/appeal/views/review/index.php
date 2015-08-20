<?php
/** @var $model AppealReview */
/** @var $this ReviewController */


$this->pageTitle = 'Обзор обращений';

$this->breadcrumbs = array(
    'Обращения граждан' => '/appeal/back',
    $this->pageTitle
);
?>

<h3 class="page-header"><?php echo $this->pageTitle; ?></h3>
<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/appeal/review/deleteAll'); ?>">Удалить выбранные</a>
    <?php echo CHtml::ajaxLink('Добавить', $this->createUrl('/appeal/review/save'), array(
        'success'=>'function(html){
            jQuery("#review_ajax_popup").html(html);
            $("#review_dialog").dialog("open");
        }',
    ), array(
        'id'=>'showExpertiseDialogBtn',
        'class' => 'btn fr',
    )); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'review_dialog',
    'options'=>array(
        'title'=>'График приема',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="review_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'ajaxUrl' => '/appeal/review',
    'id' => 'review-grid',
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
        'year',
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/appeal/review/delete", array("id" => $data->id))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/appeal/review/save", array("id" => $data->id))',
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
    $(document).on('click', '#review-grid .update', function(){
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function(data) {
                $('#review_ajax_popup').html(data);
                $("#review_dialog").dialog("open");
            }
        });
    });
</script>