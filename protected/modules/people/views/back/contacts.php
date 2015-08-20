<?php
$this->breadcrumbs[] ='Контакты';
?>


<div class="page-header">
    <h2>Контакты</h2>
</div>


<?php echo $this->renderPartial('/back/menu',array('isNewRecord'=>$model->isNewRecord,'active'=>PeopleType::CONTACTS,'people_id'=>$model->id,'type'=>$model->type));?>

<div class="form">

    <h3 style="margin-top: 0px">Контакты</h3>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'people-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'contact_name'); ?>
        <?php echo $form->textField($model,'contact_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'contact_name'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'contact_photo'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'contact_photo')); ?>
        <?php echo $form->error($model,'contact_photo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'contact_description'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'contact_description')); ?>
        <?php echo $form->error($model,'contact_description'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->