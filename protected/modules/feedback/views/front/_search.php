<?php
/* @var $this Controller */
/* @var $form CActiveForm */
/* @var $model Staff */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('/feedback/front/hotlines'),
    'id' => 'hotlines-form',
    'method' => 'get',
)); ?>

    <div class="search-min clearfix">
        <button type="submit" class="btn-default">Искать</button>
        <div>
            <?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>