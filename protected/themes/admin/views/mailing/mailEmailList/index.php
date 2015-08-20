
<?php
/** @var $model MailEmailList */
/** @var $this MailEmailListController */

$this->breadcrumbs = array(
	'Подписчики',
);
?>

<div class="page-header">
    <h2>Подписчики</h2>
</div>

<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::EMAILS));?>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/mailing/mailEmailList/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/mailing/mailEmailList/create'); ?>">
        Добавить
    </a>
    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/mailing/mailEmailList/createFile'); ?>">
        Добавить файлом
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
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        'email',
        'first_name',
        'last_name',
        array(
            'name'=>'agreement',
            'type'=>'raw',
            'value'=>'($data->agreement)?"Да":"Нет"',
            'filter' => CHtml::activeDropDownList($model, 'agreement', array(''=>'Показать все', 0=>'Нет', 1=>'Да')),
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));