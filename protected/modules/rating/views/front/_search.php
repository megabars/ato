<?php
/* @var $this Controller */
/* @var $form CActiveForm */
/* @var $model RatingDoc */
/* @var $isProject boolean */
/* @var $type int */
?>

<div class="grid-search">
    <div class="text-right"><a href="" id="toggle-search">Расширенный поиск</a></div>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl('/rating/front/index?type='.$type),
        'id' => 'search-form2',
        'method' => 'get',
    )); ?>

    <div class="search-min clearfix">
        <button type="submit" class="btn-default">Искать</button>
        <div>
            <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'placeholder' => 'Поиск по наименованию')); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>

    <div class="search-max">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'action' => Yii::app()->createUrl('/rating/front/index?type='.$type),
            'id' => 'search-form2',
            'method' => 'get',
        )); ?>
        <div class="search">
            <div class="row">
                <label class="">Название</label>
                <?php echo $form->textField($model, 'title', array('maxlength' => 255)); ?>
                <?php echo $form->error($model, 'title'); ?>
            </div>
            <?php if ($type == 1): ?>
                <div class="row">
                    <label class="">Номер и дата принятия</label>
                    <?php echo $form->textField($model, 'info', array('maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'info'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'type'); ?>
                    <?php echo $form->dropDownList($model, 'type', array('' => 'Все') + RatingLocalType::instance()->list[$type], array('class' => 'select')); ?>
                    <?php echo $form->error($model, 'type'); ?>
                </div>
            <?php endif; ?>
            <?php if ($isProject): ?>
                <?php if ($type == 5): ?>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'author'); ?>
                        <?php echo $form->textField($model, 'author', array('maxlength' => 255)); ?>
                        <?php echo $form->error($model, 'author'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'type'); ?>
                        <?php echo $form->dropDownList($model, 'type', array('' => 'Все') + RatingLocalType::instance()->list[$type], array('class' => 'select')); ?>
                        <?php echo $form->error($model, 'type'); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($type != 1): ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'year'); ?>
                <?php echo $form->dropDownList($model, 'year', array('' => 'Все') + RatingYear::instance()->list, array('class' => 'select')); ?>
                <?php echo $form->error($model, 'year'); ?>
            </div>
            <?php endif; ?>

            <div class="row">
                <?php echo CHtml::submitButton('Искать', array('class' => 'btn-default')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>