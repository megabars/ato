<?php
$this->pageTitle = $name;

$this->breadcrumbs = array(
	'Конкурсы' => '/contests/back',
	$this->pageTitle
);
?>

<div class="page-header">
	<h2>Конкурсы</h2>
</div>

<div class="tabs">
	<div class="nav-tabs">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
			<li class="<?php echo ($type=='all')?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/contests/back?type=all">Все конкурсы</a></li>
			<li class="<?php echo ($type=='opened')?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/contests/back?type=opened">Открытые конкурсы</a></li>
			<li class="<?php echo ($type=='closed')?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/contests/back?type=closed">Закрытые конкурсы</a></li>
			<li class="<?php echo ($type=='archived')?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/contests/back?type=archived">Архив конкурсов</a></li>
		</ul>
	</div>
</div>

<div class="list-group">
	<?php if (($type == 'all') || ($type == 'opened')): ?>
		<a class="btn" href="<?php echo $this->createUrl('/contests/back/create'); ?>">
			Добавить
		</a>
	<?php endif;?>
</div>

<?php
$columns = array(
	array(
		'header' => '№',
		'value' => '$row+1',
	),
	array(
		'name' => 'org',
	),
	array(
		'name' => 'title',
	),
	array(
		'header' => 'Сроки проведения',
		'value' => '$data->getPeriods()',
		'type' => 'html'
	),
);
if ($type == 'all')
	$columns[] = array(
		'name' => 'state',
		'value' => '$data->getStatus()',
	);
$columns[] = array(
	'header' => '',
	'class' => 'CButtonColumn',
	'template' => '{update}{delete}',
	'buttons' => array(
		'update' => array(
			'url' => 'Yii::app()->createUrl("/contests/back/update", array("id" => $data->id))',
		),
		'delete' => array(
			'url' => 'Yii::app()->createUrl("/contests/back/delete", array("id" => $data->id))',
		),
	),
);

$this->widget('application.widgets.adminGridView', array(
	'dataProvider' => $model->search(),
	'enablePagination' => true,
	'enableSorting' => true,
	'template' => "{items}{pager}",
	'columns' => $columns
));
?>