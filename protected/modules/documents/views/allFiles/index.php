<?php
/** @var $this AdminController */
/** @var $model Documents */
/** @var $pages StaticPage */
/** @var $users User */

$this->breadcrumbs = array(
    'Документы',
);
?>

<div class="page-header">
    <h2>Документы</h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all" href="<?php echo $this->createUrl('/documents/file/deleteAll'); ?>">
        Удалить выбранные
    </a>
<!--    <a class="btn btn-sm icons white add-new fr" href="--><?php //echo $this->createUrl('/documents/file/create'); ?><!--">-->
<!--        Добавить документ-->
<!--    </a>-->
</div>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(), //todo Надо бы переписать в один большой запрос
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => true,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'header' => 'Файл',
            'name' => 'title',
            'type' => 'raw',
            'value'=>function ($model) {
                echo $model->title.'<br>';
                if(isset($model->file)) {
                    echo '<a href="'.$model->getFileUrl($model->file).'">Скачать '. File::model()->findByPk($model->file)->ext.'</a>';
                } else {
                    if(isset($model->pdf)) {
                        echo '<a href="'.$model->getFileUrl($model->pdf).'">Скачать pdf</a><br>';
                    }
                    if(isset($model->doc)) {
                        echo '<a href="'.$model->getFileUrl($model->doc).'">Скачать doc</a><br>';
                    }
                    if(isset($model->zip)) {
                        echo '<a href="'.$model->getFileUrl($model->zip).'">Скачать zip</a>';
                    }
                }
            },
        ),
        array(
            'header' => 'Загружен для',
            'name' => 'pageTitle',
            'type' => 'raw',
            'value' => function ($model) {
                echo @StaticPage::model()->findByAttributes(array('file_group_id'=>$model->folder->group->id))->title;
            },
            'filter' => CHtml::listData($pages, 'file_group_id', 'title'),
        ),
        array(
            'header' => 'Дата загрузки',
            'name' => 'fileDate',
            'type' => 'raw',
            'value'=>function ($model) {
                if(isset($model->file)) {
                    echo date('d.m.Y', File::model()->findByPk($model->file)->date);
                } else {
                    if(isset($model->pdf)) {
                        echo '<br>'.date('d.m.Y', File::model()->findByPk($model->pdf)->date);
                    }
                    if(isset($model->doc)) {
                        echo '<br>'.date('d.m.Y', File::model()->findByPk($model->doc)->date);
                    }
                    if(isset($model->zip)) {
                        echo '<br>'.date('d.m.Y', File::model()->findByPk($model->zip)->date);
                    }
                }
            },
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'fileDate',
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
        ),
        array(
            'header' => 'Загрузил',
            'name' => 'userName',
            'type' => 'raw',
            'value'=>function ($model) {
                if(isset($model->file)) {
                    echo @User::model()->findByPk(File::model()->findByPk($model->file)->user_id)->username;
                } else {
                    if(isset($model->pdf)) {
                        echo '<div><br>'.@User::model()->findByPk(File::model()->findByPk($model->pdf)->user_id)->username.'</div>';
                    }
                    if(isset($model->doc)) {
                        echo '<div><br>'.@User::model()->findByPk(File::model()->findByPk($model->doc)->user_id)->username.'</div>';
                    }
                    if(isset($model->zip)) {
                        echo '<div><br>'.@User::model()->findByPk(File::model()->findByPk($model->zip)->user_id)->username.'</div>';
                    }
                }
            },
            'filter' => CHtml::listData($users, 'id', 'username')
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("documents/file/update", array("id" => $data->id))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("documents/file/delete", array("id" => $data->id))',
                ),
            ),
        ),
    ),
));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker() {
  $('#datepicker_for_date').datepicker({ dateFormat: 'dd.mm.yy'});
  $.datepicker.setDefaults($.datepicker.regional['ru']);
}
");