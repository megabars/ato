<div class="list-group clearfix">
    <h3>Последние изменения на портале</h3>
</div>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => false,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array('name' => 'changedModel'),
        array('name' => 'recordId'),
        array(
            'name' => 'typeOfChange',
            'filter' => array('update' => 'Изменение', 'delete' => 'Удаление', 'create' => 'Создание')
        ),
        array(
            'name' => 'userId',
            'filter' => CHtml::listData(User::model()->findAll(), 'id', 'username')
        ),
        array(
            'name' => 'date',
//            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                    'model'=>$model,
//                    'attribute'=>'date',
//                    'language' => 'ru',
//                    'options'=>array(
//                        'dateFormat'=>'yy-mm-dd',
//                    ),
//                    'htmlOptions' => array(
//                        'id' => 'datepicker_for_date',
//                        'size' => '8',
//                    ),
//                    'defaultOptions' => array(
//                        'showOn' => 'focus',
//                        'dateFormat' => 'yy-mm-dd',
//                        'showOtherMonths' => true,
//                        'selectOtherMonths' => true,
//                        'changeMonth' => true,
//                        'changeYear' => true,
//                        'showButtonPanel' => true,
//                    )
//                ), true
//            ),
            'value' => '$data->date',
            'filter' => false
        ),
    ),
));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker() {
  $('#datepicker_for_date').datepicker({ dateFormat: 'yy-mm-dd'});
  $.datepicker.setDefaults($.datepicker.regional['ru']);
}
");