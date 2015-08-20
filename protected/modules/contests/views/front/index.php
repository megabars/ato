<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Открытые конкурсы';

$this->breadcrumbs = array(
    'Открытый регион' => $this->createUrl('/Otkritiy-region'),
    'Конкурсы' => $this->createUrl('contests/front'),
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>Открытые конкурсы</h2>
    <div class="clearfix">

        <div class="right-content">
            <div class="right-menu">
                <a href="/contests/front/index" class="active">Открытые конкурсы</a>
                <a href="/contests/front/results">Итоги конкурсов</a>
                <a href="/contests/front/archive">Архив конкурсов</a>
            </div>
        </div>

        <div class="left-content">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'contests',
                'dataProvider'=>$records->search(),
                'cssFile' => false,
                'itemsCssClass' => 'table',
                'template' => '{items}{pager}',
                'columns'=>array(
                    'org',
                    array(
                        'name' => 'Название конкурса',
                        'value' => '$data->getTitleWithLink()',
                        'type' => 'html',
                    ),
                    'description_small',
                    array(
                        'name' => 'Сроки проведения',
                        'value' => '$data->getPeriods()',
                        'type'  => 'html',
                    )

                ),
                'pager'=>array(
                    'header'=>'',
                    'cssFile'=>false,
                    'firstPageLabel'=> false,
                    'prevPageLabel'=>'&larr;&nbsp;&nbsp;Предыдущая',
                    'nextPageLabel'=>'Следующая&nbsp;&nbsp;&rarr;',
                    'lastPageLabel'=> false,
                ),
            )); ?>
        </div>
    </div>
</div>

