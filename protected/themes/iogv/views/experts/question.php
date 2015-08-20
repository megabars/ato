<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Регистрация эксперта';

$this->breadcrumbs = array(
    'Экспертные советы'=>'/experts',
    'Регистрация эксперта'
);
?>

<div class="wrap">
    <h2>Наименование совета</h2>

    <h3>Регистрация эксперта</h3>

    <div class="form highlight-form table-width-50">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'alarm-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <p class="note"><span class="required">*</span> — Поля обязательные для заполнения</p>

        <div class="row">
            <?php echo $form->labelEx($model,'fio'); ?>
            <?php echo $form->textField($model,'fio', array('placeholder'=>'Фамилия, имя, отчество')); ?>
            <?php echo $form->error($model,'fio'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'phone'); ?>
            <?php
            $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'phone',
                'mask' => '+7(999) 999-99-99',
                'placeholder' => '*',
                'htmlOptions' => array('placeholder'=>'Например, +7(917) 123-45-67')
            ));
            ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email', array('placeholder'=>'Например: example@mail.com')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'text'); ?>
            <?php echo $form->textArea($model,'text'); ?>
            <?php echo $form->error($model,'text'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'file'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'file')); ?>
            <?php echo $form->error($model, 'file'); ?>
        </div>

        <div class="row captcha clearfix">
            <div class="image">
                <?php $this->widget('CCaptcha',array('clickableImage'=>true, 'showRefreshButton'=>true,)); ?><br>
            </div>
            <div class="right">
                <?php echo $form->labelEx($model,'captcha'); ?>
                <?php echo $form->textField($model,'captcha', array('placeholder'=>'Символы с изображения')); ?>
                <?php echo $form->error($model,'captcha'); ?>
            </div>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Отправить',array('class'=>'btn')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
