<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Оценка регулирующего воздействия и экспертиза нпа';

$this->breadcrumbs = array(
    'Оценка регулирующего воздействия и экспертиза нпа'
);

?>

<div class="wrap">
    <h2>Оценка регулирующего воздействия и экспертиза нпа</h2>

    <div class="clearfix">
        <div class="right-content">
            <div class="right-menu">
                <?php $this->widget('navigation.widgets.menuByAlias', array(
                    'parentId' => $this->navigationItemId,
                    'menu_alias' => 'main_menu',
                    'max_levels' => 0
                )); ?>
            </div>

            <div class="infopotok">
                <!--Begin OpenGov Infostream-widget code-->
                <script src="http://bigovernment.ru/twinvest/api/widget/infopotok/script.js" type="text/javascript"></script>
                <div id="bg-infopotok-widget-container" data-width="220" data-height="425"><img src="http://bigovernment.ru/twinvest/api/widget/loading.gif" /></div>
                <!--End of OpenGov Infostream-widget code-->
            </div>
        </div>

        <div class="left-content">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'docs-form',
                'dataProvider'=>$list->search(),
                'cssFile' => false,
                'ajaxUpdate'=>true,
                'itemsCssClass' => 'table',
                'template' => '{items}{pager}',
                'columns'=>array(
                    array(
                        'header'=>'Дата',
                        'name'=>'date',
                        'type'=>'raw',
                        'value'=>'date("d.m.Y", $data->date)',
                        'htmlOptions'=>array('class'=>'nowrap'),
                    ),
                    array(
                        'header'=>'Номер',
                        'name'=>'number',
                        'type'=>'raw',
                        'value'=> '№ 601',
                        'value'=>function ($list) {
                            echo '<div>№ 601</div>
                            <div class="link"><a href="/documents/front/view/id/'. $list->id .'">Перейти к документу</a></div>
                            <div class="link"><a href="">Скачать</a></div>';
                        },
                    ),
                    array(
                        'header'=>'Название',
                        'name'=>'preview',
                        'type'=>'raw',
                        'value'=>'"Об основных направлениях совершенствования системы государственного управления"',
                        'htmlOptions'=>array('class'=>'max500'),
                    ),
                    array(
                        'header'=>'Тип',
                        'name'=>'folder_id',
                        'type'=>'raw',
                        'value'=> '"Указ Президента РФ"',
                        'headerHtmlOptions'=>array('class'=>'last'),
                    ),
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