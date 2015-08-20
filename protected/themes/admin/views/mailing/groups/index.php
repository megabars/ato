
<?php
/** @var $model Groups */
/** @var $this GroupsController */

$this->breadcrumbs = array(
	'Группы',
);
?>

<div class="page-header">
    <h2>Группы</h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all"
       href="<?php echo $this->createUrl('/mailing/groups/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo $this->createUrl('/mailing/groups/create'); ?>">
        Добавить
    </a>
</div>

<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::GROUP));?>
<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider'=> new CArrayDataProvider($groups, array('pagination' => false)),
    'template' => "{items}{pager}",
    'htmlOptions' => array(
        'style' => 'width: 79%; float:right;',
    ),
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'name'=>'id',
            'header'=>'ID',
        ),
        array(
            'header'=>'Название группы',
            'name'=>'name',
        ),
        array(
            'name'=>'subscribers',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{subscriber} {update} {delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("/mailing/groups/update", array("id" => @$data["id"]))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("/mailing/groups/delete", array("id" => @$data["id"]))',
                ),
                'subscriber' => array(
                    'label' => 'Подписчики',
                    'imageUrl' => $this->assetsBase . '/images/subscriber.png',
                    'url' => 'Yii::app()->createUrl("/mailing/subscribe/index", array("groups_id" => @$data["id"]))',
                ),
            ),
        ),
    ),
));