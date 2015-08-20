
<?php
/** @var $model MailSubscribeFiles */
/** @var $this MailSubscribeFilesController */

$this->breadcrumbs = array(
    'Рассылки' => array('/mailing/mailSubscribe/index'),
	'Файлы рассылки',
);
?>

<div class="page-header">
    <h2>Файлы рассылки  - <?php echo @$this->subscribe->name?></h2>
</div>

<div class="list-group">
    <a class="btn fr"
        href="<?php echo $this->createUrl('/mailing/mailSubscribeFiles/create/',array('subscribe'=>@$this->subscribe->id)); ?>">
        Добавить
    </a>
    <a class="btn btn-warning icon icon-trash remove-all"
       href="<?php echo $this->createUrl('/mailing/mailSubscribeFiles/deleteAll'); ?>">
        Удаление
    </a>
</div>

<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::MAIN));?>
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
          'name'=>'photo',
          'type'=>'raw',
          'value'=>'Chtml::image($data->getSmallUrl(),"",array("class"=>"grid-small-image"))',
          'filter'=>'',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));