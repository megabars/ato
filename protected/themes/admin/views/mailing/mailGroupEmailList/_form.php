<?php
/* @var $this MailGroupEmailListController */
/* @var $model MailGroupEmailList */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mail-group-email-list-form',
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'group_id'); ?>
        <?php echo @$this->group->name?>
        <?php echo $form->error($model,'group_id'); ?>
    </div>

            <div class="row">
            <?php echo $form->labelEx($model,'list_id'); ?>
            <?php echo $form->dropDownList($model,'list_id',CHtml::listData(MailEmailList::model()->findAll(array('condition' => 'id!=0', 'order' => 'email')),'id','email')); ?>
            <?php echo $form->error($model,'list_id'); ?>
        </div>


        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->