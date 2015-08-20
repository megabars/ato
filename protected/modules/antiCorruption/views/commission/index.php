<?php
/** @var $model AcCommission */
/** @var $this CommissionController */


$this->pageTitle = 'Комиссия Администрации Томской области по соблюдению требований к служебному поведению';

$this->breadcrumbs = array(
    'Противодействие коррупции' => '/antiCorruption/back',
    $this->pageTitle
);
?>

<h3 class="page-header"><?php echo $this->pageTitle; ?></h3>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'commission_dialog',
    'options'=>array(
        'title'=>'Данные раздела',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow();}',
        'close' => 'js:function(){overlayHide();}',
    ),
)); ?>
    <div id="commission_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>


    <div class="buttons" style="margin: 5px 0">
        <a class="btn btn-light" href="/antiCorruption/members">Состав комиссии</a>
        <a class="btn btn-light" href="/antiCorruption/schedule">План работы</a>
        <a class="btn btn-light" href="/antiCorruption/meeting">Материалы заседаний</a>
        <a class="btn btn-light" href="/antiCorruption/info">Информационные материалы</a>
        <a class="btn btn-light" href="/antiCorruption/appeal">Формы обращений</a>
    </div>


<?php if($model): ?>
    <div class="buttons" style="margin: 5px 0; text-align: right;">
        <?php echo CHtml::ajaxLink('Редактировать раздел', $this->createUrl('/antiCorruption/commission/save/id/1'), array(
            'success'=>'function(html){
                jQuery("#commission_ajax_popup").html(html);
                $("#commission_dialog").dialog("open");
            }',
        ), array(
            'id'=>'showPublicDialogBtn',
            'class' => 'btn',
        )); ?>
    </div>

    <h3>Указ Губернатора Томской области о Комиссии по соблюдению требований к служебному поведению государственных гражданских служащих Томской области и урегулированию конфликта интересов</h3>
    <div style="margin: 10px 0 30px;">
        <?php echo $model->decree; ?>
    </div>

    <h3>Положение</h3>
    <div style="margin: 10px 0 30px;">
        <?php echo $model->regulation; ?>
    </div>

    <?php else: ; ?>
    <div class="buttons" style="margin: 5px 0; text-align: right; ">
        <?php echo CHtml::ajaxLink('Добавить данные в раздел', $this->createUrl('/antiCorruption/commission/save'), array(
            'success'=>'function(html){
                jQuery("#commission_ajax_popup").html(html);
                $("#commission_dialog").dialog("open");
            }',
        ), array(
            'id'=>'showPublicDialogBtn',
            'class' => 'btn',
        )); ?>
    </div>
<?php endif; ?>