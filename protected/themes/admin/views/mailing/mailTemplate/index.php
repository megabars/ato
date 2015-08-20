
<?php
/** @var $model MailTemplate */
/** @var $this MailTemplateController */

$this->breadcrumbs = array(
	'Шаблоны',
);
?>

<div class="page-header">
    <h2>Шаблоны</h2>
</div>

<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::TEMPLATE));?>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/mailing/mailTemplate/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/mailing/mailTemplate/create'); ?>">
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
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        'name',
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));