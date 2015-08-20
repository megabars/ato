<?php
/* @var $this RatingFeedbackController */
/* @var $model RatingFeedback */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'Открытые данные' => array('/Otkritiy-region'),
    'Оценка регулирующего воздействия и экспертиза нпа' => array('/rating/front'),
    'Получать уведомление о проведении ОРВ и экспертизы'
);
?>
<div class="wrap">
    <h3>
        Внимание! Вы можете подписаться на рассылку уведомлений о проведении процедуры оценки регулирующего воздействия проектов нормативных правовых актов Томской области и экспертизы действующих нормативных правовых актов Томской области
    </h3>

    <h2>Получать уведомление о проведении ОРВ и экспертизы</h2>
    <div class="clearfix">
        <div class="right-content">
            <div class="right-menu">
                <?php $this->widget('navigation.widgets.menuByAlias', array(
                    'menu_alias' => 'main_menu',
                    'max_levels' => 1,
                    'parentId' => $parent_id,
                )); ?>
            </div>

            <div class="infopotok">
                <!--Begin OpenGov Infostream-widget code-->
                <script src="http://bigovernment.ru/twinvest/api/widget/infopotok/script.js" type="text/javascript"></script>
                <div id="bg-infopotok-widget-container" data-width="220" data-height="425"><img src="http://bigovernment.ru/twinvest/api/widget/loading.gif" /></div>
                <!--End of OpenGov Infostream-widget code-->
            </div>
        </div>

        <div class="left-content">
    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'rating-feedback-feedback-form',
            'enableAjaxValidation'=>false,
        )); ?>

        <p class="note">Поля со <span class="required">*</span> обязательны для заполнения.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'fio'); ?>
            <?php echo $form->textField($model,'fio'); ?>
            <?php echo $form->error($model,'fio'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'phone'); ?>
            <?php echo $form->textField($model,'phone'); ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email'); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'info'); ?>
            <?php echo $form->textArea($model,'info'); ?>
            <?php echo $form->error($model,'info'); ?>
        </div>


        <div class="row buttons">
            <?php echo CHtml::submitButton('Отправить', array('class' => 'btn-default')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
        </div>
</div>
</div>