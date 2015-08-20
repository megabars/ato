<?php

/** @var $record NavItems */
/** @var $this AdminController */

$this->breadcrumbs = array(
    'Управление меню' => array('/navigation/menu'),
    'Структура представления данных'
);
?>

<div class="page-header">
    <h2>Структура представления данных</h2>
</div>

<div class="list-group clearfix">
    <?php if ($this->visibleNavigationElement('other')) : ?>
        <?php echo CHtml::ajaxLink('Создать элемент', $this->createUrl('/navigation/back/save', array('menuId' => $menuId)), array(
            'success'=>'function(html){
                    jQuery("#navigation_ajax_popup").html(html);
                    $("#navigation_dialog").dialog("open");
                    if ($("#entry").size()) {
                        $("#NavItems_title").syncTranslit({destination: "NavItems_navItemUrl"});
                    }
                }',
        ), array(
            'id'=>'showMenuItemDialogBtn',
            'class' => 'btn btn-orange icon icon-plus-white',
        )); ?>

        <a id="sorting"  class="btn icon icon-ok" data-url="<?php echo $this->createUrl('/navigation/back/sort'); ?>">
            Сохранить порядок
        </a>

    <?php endif; ?>

<!--<span id="sorting" class="btn btn-orange btn-ajax" data-url="--><?php //echo $this->createUrl('/navigation/back/sort'); ?><!--">-->
<!--    Сохранить порядок-->
<!--</span>-->

    <!--    <a class="btn btn-sm icons white add-new fr" href="--><?php //echo $this->createUrl('/navigation/menu/index'); ?><!--">-->
<!--        Управление меню-->
<!--    </a>-->

    <div id="status-msg"></div>
</div>

<div id="navigation-list" class="nav-sort fl">
    <?php //        foreach (CHtml::listData(NavMenu::model()->findAll(), 'id', 'name') as $menuId => $name) {
    //            echo CHtml::tag('h3',array('class' => 'menu_name')) . $name . CHtml::closeTag('h3');

    $this->widget('navigation.widgets.menuByAlias', array(
        'menu_alias' => NavMenu::model()->findByPk($menuId)->alias,
        'draggable' => true,
//                'submenuHtmlOptions'=>array(
//                    'class' => 'sub-menu'
//                ),
        'htmlOptions' => array(
            'class' => 'sortable fl menu-items-list',
        ),
    ));

    //            echo CHtml::tag('div',array('style' => 'height: 25px; clear:both')).CHtml::closeTag('div');
    //        }
    ?>
</div>

<br/>
<br/>
<?php $this->widget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'message_dialog',
    'htmlOptions' => array('class'=>'message_modal'),
    'options'=>array(
        'title'=>'Сообщение',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'navigation_dialog',
    'options'=>array(
        'title'=>'Элемент меню',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="navigation_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>