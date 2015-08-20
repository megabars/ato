<?php
/* @var $this AdminController */
/* @var $model Contact */

$this->breadcrumbs = array(
    'Контактная информация' => '/contact/back/index',
    'Редактирование контактных данных',
);
?>

<h1>Редактирование контактных данных</h1>

    <div class="tabs">
        <?php $this->widget('zii.widgets.jui.CJuiTabs',array(
            'id' => 'contact',
            'tabs'=> array(
                'Основные данные' => $this->renderPartial('_form', array('model' => $model), true, false),
                'Контактные данные' => $this->renderPartial('../details/index', array('model' => $details), true, false),
            ),
            'htmlOptions' => array(
                'class' => 'nav-tabs'
            ),
            // additional javascript options for the tabs plugin
            'options'=>array(
            //'select'=> 'js:function(event, ui) { $("[id $=_dialog]").dialog("close") }' //закрываем диалоги
            ),
        ));
        ?>
    </div>