<?php
/* @var $this PeopleController */
/* @var $model People */
/* @var $form CActiveForm */
?>
<script>
    $(function(){
        $('.no-click').click(function(){return false;});
    })
</script>
<?php
if(!$model->isNewRecord)
echo $this->renderPartial('/back/menu',array('isNewRecord'=>$model->isNewRecord,'active'=>PeopleType::MAIN,'people_id'=>$model->id,'type'=>$model->type));
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'people-form',
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>
            <div class="row">
            <?php echo $form->labelEx($model,'type'); ?>
            <?php echo $form->dropDownList($model,'type',People::getTypeGroupLabels($this->type));?>
            <?php echo $form->error($model,'type'); ?>
        </div>

    <?php
    $rules = array_merge(
        array_keys(People::getTypeGroupLabels(People::TERR)),
        array_keys(People::getTypeGroupLabels(People::LAW)),
        array_keys(People::getTypeGroupLabels(People::COMMITTEE))
//        array_keys(People::getTypeGroupLabels(People::POWER)),
//        array_keys(People::getTypeGroupLabels(People::OTHER_POWER))
    );
    if(!in_array($model->type,$rules) and !in_array(Yii::app()->controller->id,array('terr','law'))){?>
            <div class="row">
            <?php echo $form->labelEx($model,'photo'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
            <?php echo $form->error($model,'photo'); ?>
        </div>
    <?php } else { ?>
        <div class="row">
            <?php echo $form->labelEx($model,'main_info',array('label'=>(!in_array($model->type,array_merge(
                array_keys(People::getTypeGroupLabels(People::COMMITTEE)),
                array_keys(People::getTypeGroupLabels(People::POWER)),
                array_keys(People::getTypeGroupLabels(People::OTHER_POWER))))?'Наименование Органа власти':'Наименование'))); ?>
            <?php echo $form->textField($model,'main_info',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'main_info'); ?>
        </div>
<!--        --><?php //if(in_array($model->type,array_merge(array(People::TERR_FED),array_keys(People::getTypeGroupLabels(People::LAW))))){?>
<!--                <div class="row">-->
<!--                    --><?php //echo $form->labelEx($model,'url'); ?>
<!--                    --><?php //echo $form->textField($model,'url',array('size'=>60,'maxlength'=>500)); ?>
<!--                    --><?php //echo $form->error($model,'url'); ?>
<!--                </div>-->
<!--            --><?php //} ?>
    <?php } ?>

    <?php if(in_array($model->type,array_merge(array_keys(People::getTypeGroupLabels(People::POWER)), array_keys(People::getTypeGroupLabels(People::OTHER_POWER))))){?>
        <div class="row">
            <?php echo $form->labelEx($model,'url',array('label'=>'Наименование')); ?>
            <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'url'); ?>
        </div>
    <?php } ?>

    <div class="row">
            <?php echo $form->labelEx($model,'full_name'); ?>
            <?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'full_name'); ?>
        </div>

    <?php if(!in_array($model->type,$rules)  and !in_array(Yii::app()->controller->id,array('terr','law'))){?>
            <div class="row">
            <?php echo $form->labelEx($model,'job'); ?>
            <?php echo $form->textField($model,'job',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'job'); ?>
        </div>
    <?php } ?>

        <div class="row checkbox-list">
            <?php echo $form->checkBox($model,'state'); ?>
            <?php echo $form->labelEx($model,'state'); ?>
            <?php echo $form->error($model,'state'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'contact_address'); ?>
            <?php echo $form->textField($model,'contact_address',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'contact_address'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'contact_phone'); ?>
            <?php $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'contact_phone',
                'mask' => '+7(9999) 999-999',
                'placeholder' => '*',
            )); ?>
            <?php echo $form->error($model,'contact_phone'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'contact_site'); ?>
            <?php echo $form->textField($model,'contact_site',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'contact_site'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'contact_email'); ?>
            <?php echo $form->textField($model,'contact_email',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'contact_email'); ?>
        </div>

    <?php if(!in_array($model->type,$rules)  and !in_array(Yii::app()->controller->id,array('terr','law'))){?>

        <div class="row">
            <?php echo $form->labelEx($model,'contact_fax'); ?>
            <?php $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'contact_fax',
                'mask' => '+7(9999) 999-999',
                'placeholder' => '*',
            )); ?>
            <?php echo $form->error($model,'contact_fax'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'social_vk'); ?>
            <?php echo $form->textField($model,'social_vk',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'social_vk'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'social_tw'); ?>
            <?php echo $form->textField($model,'social_tw',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'social_tw'); ?>
        </div>

            <div class="row">
            <?php echo $form->labelEx($model,'social_fb'); ?>
            <?php echo $form->textField($model,'social_fb',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'social_fb'); ?>
        </div>
    <?php } ?>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->