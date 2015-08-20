<?php
/* @var $this Controller */
/* @var $form CActiveForm */
/* @var $model Npa */
?>

<div class="text-right"><a href="" id="toggle-search">расширенный поиск</a></div>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('/npa/front/archive'),
    'id' => 'search-form',
    'method' => 'get',
)); ?>

<div class="search-min clearfix">
    <button type="submit" class="btn-default">Искать</button>
    <div>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('/npa/front/archive'),
    'id' => 'search-form2',
    'method' => 'get',
)); ?>
<div class="search-max">
    <div class="row">
        <label class="">Название</label>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'year'); ?>
        <?php echo $form->dropDownList($model, 'year', array(0 => 'Любой', 2013=>'2013',2014=>'2014',2015=>'2015',), array('class' => 'select')); ?>
        <?php echo $form->error($model, 'year'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'month'); ?>
        <?php echo $form->dropDownList($model, 'month', array(0 => 'Любой',"Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"), array('class' => 'select')); ?>
        <?php echo $form->error($model, 'month'); ?>
    </div>


    <div class="row">
        <?php echo CHtml::submitButton('Искать', array('class' => 'btn-default')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
