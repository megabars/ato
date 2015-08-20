<?php
$this->pageTitle = $name;

$this->breadcrumbs = array(
	'Оценка регулирующего воздействия проектов НПА и экспертиза НПА' => '/rating/back',
	$name,
);
?>
<div class="page-header">
	<h2><?php echo $this->pageTitle ?></h2>
</div>

<div class="tabs">
    <div class="nav-tabs fake-tabs">
        <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
            <li class="<?php echo ($type==1)?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/rating/back?type=1">Информационные материалы</a>
            <li class="<?php echo ($type==5)?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/rating/back?type=5">Публичные консультации</a>
            <li class="<?php echo ($type==2)?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/rating/back?type=2">Заключения об ОРВ</a>
            <li class="<?php echo ($type==3)?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/rating/back?type=3">Мониторинг фактического воздействия НПА</a>
            <li class="<?php echo ($type==4)?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/rating/back?type=4">План экспертизы</a>
            <li class="<?php echo ($type==6)?'ui-tabs-active ui-state-active':'' ?>"><a class="list-group-item" href="/rating/back?type=6">Экспертиза НПА</a>
        </ul>
    </div>
</div>

<div class="list-group">
    <a class="btn" href="<?php echo $this->createUrl('/rating/back/create', array('type' => $type)); ?>">
        Добавить
    </a>
</div>

<?php

$view = $isProject ? '_project' : '_doc';
	$this->renderPartial('_index/'.$view, array(
		'model'	=>	$model,
		'type' 	=> $type,
	));
?>
