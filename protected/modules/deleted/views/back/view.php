<?php
/** @var $model BaseActiveRecord */
/** @var $this BackController */

$this->breadcrumbs = array(
    'Корзина' => '/deleted/back/index',
    $this->pageTitle
);
?>

<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group">
    <a
        class="btn btn-warning icon icon-remove remove-all"
        data-confirm="Вы действительно хотите безвозвратно удалить все выбранные записи?"
        href="<?php echo $this->createUrl('/deleted/back/deleteAll/', array('name'=>$_GET["name"])); ?>">
        Удалить выбранные
    </a>
    <a
        class="btn icon icon-ok remove-all"
        data-confirm="Вы действительно хотите восстановить все выбранные записи?"
        href="<?php echo $this->createUrl('/deleted/back/restoreAll', array('name'=>$_GET["name"])); ?>">
        Восстановить выбранные
    </a>

</div>

<?php
$columns = array();
foreach($model->attributes as $attribute => $value){
    if($attribute == 'photo') {
        $columns[] = array(
            'name' => $attribute,
            'type' => 'html',
            'sortable' => false,
            'value'=>'CHtml::image($data->getSmallUrl())',
        );
    } elseif($attribute == 'title' || $attribute == 'name' || $attribute == 'question') {
        $columns[] = array(
            'name' => $attribute,
            'value' => '$data->'.$attribute,
        );
    } elseif($attribute == 'date') {
        $columns[] = array(
            'name' => $attribute,
            'value' => '(ctype_digit($data->'.$attribute.'))? date("d.m.Y H:i", $data->'.$attribute.') : $data->'.$attribute.';',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'date',
                'language' => 'ru',
                'options'=>array(
                    'dateFormat'=>'dd.mm.yy',
                ),
                'htmlOptions' => array(
                    'id' => 'datepicker_for_date',
                    'size' => '8',
                ),
                'defaultOptions' => array(
                    'showOn' => 'focus',
                    'dateFormat' => 'dd.mm.yy',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), true
            ),

        );
    }
}
array_unshift($columns,
    array(
        'class' => 'StyledCheckBoxColumn',
        'selectableRows' => 2,
        'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
    )
);
array_push($columns,
    array(
        'header' => 'Действия',
        'class' => 'CButtonColumn',
        'template' => '{restore}{delete}',
        'deleteConfirmation'=>"Вы действительно хотите безвозвратно удалить эту запись?",
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/deleted/back/delete", array("name" => $_GET["name"], "id" => $data->id))',
                'options' => array(
                    'title'=>'Удалить безвозвратно'
                )
            ),
            'restore' => array(
                'url' => 'Yii::app()->createUrl("/deleted/back/restore", array("name" => $_GET["name"], "id" => $data->id))',
                'options'=>array(
                    'class' => 'restore',
                    'onclick' => 'return false;',
                    'title'=>'Восстановить'
                )
            ),
        ),
    )
);

$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'id' => 'model-grid',
    'enableSorting' => true,
    'summaryText' => '',
    'ajaxUpdate' => true,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'template' => "{items}{pager}",
    'columns' => $columns
));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker() {
  var value =
  $('#datepicker_for_date').datepicker({ dateFormat: 'dd.mm.yy'});
  $.datepicker.setDefaults($.datepicker.regional['ru']);

  if($('#datepicker_for_date').val()) {
     $('#datepicker_for_date').datepicker('setDate', new Date($('#datepicker_for_date').val()*1000));
  }
}
");
?>
<script type="text/javascript">
    $(document).on('click', '#model-grid .restore', function(){
        if(!confirm('Вы действительно хотите восстановить эту запись?')) return false;
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            success: function() {
                $.fn.yiiGridView.update("model-grid");
            }
        });
    });
</script>