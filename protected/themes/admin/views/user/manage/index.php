<?php
$this->breadcrumbs=array(
	UserModule::t('Manage'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<div class="page-header">
	<h2><?php echo UserModule::t("Manage Users"); ?></h2>
</div>

<div class="list-group">
    <a href="<?php echo $this->createUrl('/user/manage/create'); ?>" class="btn">Новый пользователь</a>
    <a href="<?php echo $this->createUrl('/user/profileField/admin'); ?>" class="btn"><?php echo UserModule::t('Manage Profile Field') ?></a>
</div>


<!--<p>--><?php //echo UserModule::t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?><!--</p>-->

<?php //echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">-->
<?php //$this->renderPartial('_search',array(
//    'model'=>$model,
//)); ?>
<!--</div>-->
<!-- search-form -->

<?php $this->widget('application.widgets.adminGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'template' => "{items}{pager}",
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => '$data->id',
		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'UHtml::markSearch($data,"username")',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		'create_at',
		'lastvisit_at',
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
