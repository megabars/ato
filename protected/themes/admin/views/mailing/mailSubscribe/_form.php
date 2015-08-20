<?php
/* @var $this MailSubscribeController */
/* @var $model MailSubscribe */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mail-subscribe-form',
	'enableAjaxValidation'=>false,
)); ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
            <div class="row">
            <?php echo $form->labelEx($model,'group_id'); ?>
            <?php echo $form->dropDownList($model,'group_id',CHtml::listData(MailGroup::model()->findAll(),'id','name')); ?>
            <?php echo $form->error($model,'group_id'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'template_id'); ?>
            <?php echo $form->dropDownList($model,'template_id',CHtml::listData(MailTemplate::model()->findAll(),'id','name')); ?>
            <?php echo $form->error($model,'template_id'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'sender_email'); ?>
            <?php echo $form->textField($model,'sender_email',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'sender_email'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'date'); ?>
            <?php
            $model->date = (!empty($model->date)?date("d.m.Y H:i",$model->date):date("d.m.Y H:i"));
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'date',
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'dd.mm.yy',
                ),
            ));
            ?>
            <?php echo $form->error($model,'date'); ?>
        </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->