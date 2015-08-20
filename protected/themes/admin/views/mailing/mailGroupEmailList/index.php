
<?php
/** @var $model MailGroupEmailList */
/** @var $this MailGroupEmailListController */

$this->breadcrumbs = array(
    'Группа подписчиков - '.@$this->group->name,
);
?>

<div class="page-header">
    <h2>Группа подписчиков - <?php echo @$this->group->name?></h2>
</div>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
        href="<?php echo $this->createUrl('/mailing/mailGroupEmailList/deleteAll'); ?>">
        Удаление
    </a>
    <a class="btn fr"
        href="<?php echo $this->createUrl('/mailing/mailGroupEmailList/create',array('group_id'=>@$this->group->id)); ?>">
        Добавить
    </a>
    <a class="btn fr"
        href="<?php echo $this->createUrl('/mailing/mailGroupEmailList/createFile',array('group_id'=>@$this->group->id)); ?>">
        Добавить файлом
    </a>
</div>

<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::GROUP));?>
<br/>
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
        array(
            'name'=>'list_id',
            'type'=>'raw',
            'value'=>'@$data->list->email',
            'filter'=>'',
        ),
        array(
            'name'=>'group_id',
            'type'=>'raw',
            'value'=>'@$data->groups->name',
            'filter'=>'',
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));