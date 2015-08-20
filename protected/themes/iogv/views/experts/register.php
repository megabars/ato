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

    <div class="form highlight-form">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'alarm-form',
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <p class="note"><span class="required">*</span> — Поля обязательные для заполнения</p>

        <div class="input-group">
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
        </div>

        <div class="input-group">
            <div class="row">
                <?php echo $form->labelEx($model,'email'); ?>
                <?php echo $form->textField($model,'email', array('placeholder'=>'Например: example@mail.com')); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'index'); ?>
                <?php echo $form->textField($model,'index'); ?>
                <?php echo $form->error($model,'index'); ?>
            </div>
        </div>

        <div class="input-group">
            <div class="row">
                <?php echo $form->labelEx($model,'city'); ?>
                <?php echo $form->textField($model,'city'); ?>
                <?php echo $form->error($model,'city'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'region'); ?>
                <?php echo $form->dropDownList($model,'region',$model->region_list, array('class'=>'select')); ?>
                <?php echo $form->error($model,'region'); ?>
            </div>
        </div>

        <div class="input-group">
            <div class="row">
                <?php echo $form->labelEx($model,'skills'); ?>
                <?php echo $form->textField($model,'skills'); ?>
                <?php echo $form->error($model,'skills'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'education'); ?>
                <?php echo $form->dropDownList($model,'education',$model->education_list, array('class'=>'select')); ?>
                <?php echo $form->error($model,'education'); ?>
            </div>
        </div>

        <div class="input-group">
            <div class="row">
                <?php echo $form->labelEx($model,'scientific'); ?>
                <?php echo $form->dropDownList($model,'scientific',$model->scientific_list, array('class'=>'select')); ?>
                <?php echo $form->error($model,'scientific'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'experience'); ?>
                <?php echo $form->dropDownList($model,'experience',$model->experience_list, array('class'=>'select')); ?>
                <?php echo $form->error($model,'experience'); ?>
            </div>
        </div>

        <div class="input-group resource">
            <div class="row">
                <label>Ресурсы в сети</label>
                <?php echo CHtml::dropDownList('ExpertsForm[resources_type][]', $model->resources_type, $model->resources_type_site, array('class'=>'select')); ?>
                <?php echo $form->error($model,'scientific'); ?>
            </div>
            <div class="row">
                <label>&nbsp;</label>
                <?php echo CHtml::textField('ExpertsForm[resources][]'); ?>
                <?php echo $form->error($model,'resources'); ?>
            </div>
        </div>

        <div id="after-copyed"></div>
        <a id="copy" href="">+ Добавить еще ресурс</a>

        <script id="app-view-2" type="text/template">
            <div class="input-group resource">
                <div class="row">
                    <label>Ресурсы в сети</label>
                    <?php echo CHtml::dropDownList('ExpertsForm[resources_type][]', $model->resources_type, $model->resources_type_site, array('class'=>'select')); ?>
                    <?php echo $form->error($model,'scientific'); ?>
                </div>
                <div class="row">
                    <label>&nbsp;</label>
                    <?php echo CHtml::textField('ExpertsForm[resources][]'); ?>
                    <?php echo $form->error($model,'resources'); ?>
                </div>
            </div>
        </script>

        <script>
            $(document).ready(function(){
                $('#copy').on('click',function(e){
                    var item = $('#app-view-2').html();
                    $(item).insertBefore('#after-copyed');
                    $(".select").selecter();
                    e.preventDefault();
                });
            });
        </script>

        <div class="input-group">
            <div class="row">
                <?php echo $form->labelEx($model,'profession_skill'); ?>
                <?php echo $form->textArea($model,'profession_skill'); ?>
                <?php echo $form->error($model,'profession_skill'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'history'); ?>
                <?php echo $form->textArea($model,'history'); ?>
                <?php echo $form->error($model,'history'); ?>
            </div>
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
            <?php echo CHtml::submitButton('Зарегестрироваться',array('class'=>'btn')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
