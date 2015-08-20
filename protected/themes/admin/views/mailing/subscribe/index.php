
<?php
/** @var $model Subscribe */
/** @var $this SubscribeController */

$this->breadcrumbs = array(
	'Подписчики',
);
?>

<div class="page-header">
    <h2>Подписчики - <?php echo @$this->group['name']?></h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all"
       href="<?php echo $this->createUrl('/mailing/subscribe/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/mailing/subscribe/create'); ?>">
        Добавить
    </a>
</div>

<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::SUBSCRIBE));?>
<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider'=> new CArrayDataProvider($model, array('pagination' => false)),
    'enablePagination' => true,
    'enableSorting' => false,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'htmlOptions' => array( 'style' => 'width: 79%; float:right;'),
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        'email',
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/mailing/subscribe/update", array("id" => @$data["id"]))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/mailing/subscribe/delete", array("id" => @$data["id"]))',
                ),
            ),
        ),
    ),
));