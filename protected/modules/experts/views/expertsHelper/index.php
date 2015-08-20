
<?php
/** @var $model ExpertsHelper */
/** @var $this ExpertsHelperControllerController */

$this->breadcrumbs = array(
	'Справочник экспертных советов',
);
?>

<div class="page-header">
    <h2>Настройки регистрации экспертов</h2>
</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'experts-helper-form-settings',
    'enableAjaxValidation'=>false,
)); ?>
<div class="row">
    <?php echo $form->labelEx($modelSettings,'message'); ?>
    <?php echo $form->textArea($modelSettings,'message',array('rows'=>6, 'cols'=>50)); ?>
</div>
<div class="row">
    <?php echo $form->checkBox($modelSettings, 'isActive'); ?> <?php echo $form->labelEx($modelSettings,'isActive'); ?>
</div>
<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
</div>

<?php $this->endWidget(); ?>
</div>

<div class="page-header">
    <h2>Список экспертных советов</h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all"
       href="<?php echo $this->createUrl('/experts/ExpertsHelper/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/experts/ExpertsHelper/create'); ?>">
        Добавить
    </a>
</div>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => false,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array('name' => 'name'),
        array(
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => false,
            'filter' => CHtml::activeDropDownList($model, 'state', PublicType::instance()->list),
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/expertshelper/view", array("id" => $data->id))',
                    'options' => array("target" => "_blank"),
                ),
            ),
        ),
    ),
));