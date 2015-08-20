<?php
/** @var $model Portal */
/** @var $this PortalController */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'Настройка доступа' => array('/admin/main/StaticPageAccess'),
    $portal->title,
);
?>

<div class="page-header">
    <h2>Редактирование правил</h2>
</div>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'portal-form',
        'enableAjaxValidation' => false,
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'rule'); ?>
        <?php echo $form->dropDownList($model, 'rule', $items,
            array('multiple' => 'multiple', 'class' => 'chosen-select', 'options' => $selected)); ?>
        <?php echo $form->error($model, 'rule'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->