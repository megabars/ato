<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Открытые данные';

$this->breadcrumbs = array(
    'Открытые данные'
);
?>

<div class="wrap">
    <h2>Открытые данные</h2>
    <div class="clearfix">

        <div class="right-content">
            <div class="right-menu">
                <a href="/opendata">Данные</a>
                <a href="">О проекте</a>
                <a href="">Условия использования</a>
                <a href="/opendata/form" class="active">Обратная связь</a>
                <a href="">Разработчикам</a>
                <a href="">Приложения и программы</a>
                <a href="/opendata/statistic">Статистика</a>
            </div>
        </div>

        <div class="left-content">

            <h3>Обратная связь</h3>

            <div class="opendata form">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'opendata-form',
                    'htmlOptions' => array(
                        'class' => 'feedback_form',
                    ),
                    'enableAjaxValidation' => TRUE,
                    'enableClientValidation' => TRUE,
                    'clientOptions' => array(
                        'validateOnSubmit' => TRUE,
                    ),
                )); ?>

                <div class="hint"><span class="required">*</span> — Поля обязательные для заполнения</div>

                <div class="input-group row">
                    <div class="row fr">
                        <?php echo $form->labelEx($model, 'email'); ?>
                        <?php echo $form->textField($model, 'email', array('maxlength' => 255, 'placeholder'=>'Например, name@mail.ru')); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                    <div class="row fio">
                        <?php echo $form->labelEx($model, 'fio'); ?>
                        <?php echo $form->textField($model, 'fio', array('maxlength' => 255, 'placeholder'=>'Например, Иванов Иван Иванович')); ?>
                        <?php echo $form->error($model, 'fio'); ?>
                    </div>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'subject'); ?>
                    <?php echo $form->textField($model, 'subject', array('maxlength' => 255, 'placeholder'=>'Тема сообщения')); ?>
                    <?php echo $form->error($model, 'subject'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'text', array('id'=>'FeedbackForm_text')); ?>
                    <?php echo $form->textArea($model, 'text', array('rows' => 7, 'placeholder'=>'Опишите Вашу проблему или задайте вопрос')); ?>
                    <?php echo $form->error($model, 'text'); ?>
                </div>

                <?php if (CCaptcha::checkRequirements()): ?>
                    <div class="row captcha clearfix">
                        <div class="image">
                            <?php $this->widget('CCaptcha',array(
                                'clickableImage'=>true,
                                'showRefreshButton'=>true,
                                'id' => uniqid('das')
                            )); ?><br>
                        </div>
                        <div class="right">
                            <?php echo $form->labelEx($model,'captcha'); ?>
                            <?php echo $form->textField($model,'captcha'); ?>
                            <?php echo $form->error($model,'captcha'); ?>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="row">
                    <?php echo CHtml::submitButton('Отправить', array('class' => 'btn')); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>