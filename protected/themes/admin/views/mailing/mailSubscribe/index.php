
<?php
/** @var $model MailSubscribe */
/** @var $this MailSubscribeController */

$this->breadcrumbs = array(
	'Рассылки',
);
?>

<div class="page-header">
    <h2>Рассылки</h2>
</div>

<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::MAIN));?>

<div class="list-group">
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/mailing/mailSubscribe/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/mailing/mailSubscribe/create'); ?>">
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
//        array(
//            'name'=>'group_id',
//            'type'=>'raw',
//            'value'=>'($data->group)?$data->group->name:""',
//            'filter'=>CHtml::listData(MailGroup::model()->findAll(),'id','name'),
//        ),
//        array(
//            'name'=>'template_id',
//            'type'=>'raw',
//            'value'=>'($data->template)?$data->template->name:""',
//            'filter'=>CHtml::listData(MailTemplate::model()->findAll(),'id','name'),
//        ),
        array(
            'header'=>'',
            'type'=>'raw',
            'value'=>'Chtml::link("Файлы (".$data->filesCount.")","/mailing/mailSubscribeFiles/index/subscribe/".$data->id)',
            'filter'=>"",
        ),
        array(
            'name'=>'date',
            'type'=>'raw',
            'value'=>'($data->date)?date("d.m.Y H:i",$data->date):""',
            'filter'=>'',
        ),
        array(
            'name'=>'is_send',
            'type'=>'raw',
            'value'=>'($data->is_send)?"Да":"Нет"',
            'filter' => CHtml::activeDropDownList($model, 'is_send', array(''=>'Показать все', 0=>'Нет', 1=>'Да')),
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));