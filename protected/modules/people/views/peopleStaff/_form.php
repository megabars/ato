<?php
/* @var $this PeopleStaffController */
/* @var $model PeopleStaff */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'people-staff-form',
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'photo'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
        <?php echo $form->error($model,'photo'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'full_name'); ?>
            <?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'full_name'); ?>
        </div>
        <?php  if(in_array($this->people->type,array_merge(array_keys(People::getTypeGroupLabels(People::LAW)),array_keys(People::getTypeGroupLabels(People::POWER)),array(People::TYPE_DUMA,People::IOGV)))){
            if(!empty($_GET['unit_id']) and empty($model->unit_id))
                $model->unit_id = (int)@$_GET['unit_id'];
            ?>
        <?php echo $form->labelEx($model,'unit_id',array('label'=>'Подразделение')); ?>
        <?php echo $form->dropDownList($model,'unit_id',CHtml::listData(PeopleUnit::model()->findAll('people_id='.(int)@$this->people->id),'id','name'),array('empty'=>'Без подразделения')); ?>
        <?php echo $form->error($model,'unit_id'); ?>
        <?php } ?>

            <div class="row">
            <?php echo $form->labelEx($model,'job'); ?>
            <?php echo $form->textField($model,'job',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'job'); ?>
        </div>

    <div class="row">
            <?php echo $form->checkBox($model,'main'); ?>
            <?php echo $form->labelEx($model,'main'); ?>
            <?php echo $form->error($model,'main'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'cabinet'); ?>
            <?php echo $form->textField($model,'cabinet',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'cabinet'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'contact_phone'); ?>
            <?php echo $form->textField($model,'contact_phone',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'contact_phone'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'contact_fax'); ?>
            <?php echo $form->textField($model,'contact_fax',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'contact_fax'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'contact_email'); ?>
            <?php echo $form->textField($model,'contact_email',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'contact_email'); ?>
        </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->