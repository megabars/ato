<?php
/* @var $this Controller */
/* @var $form CActiveForm */
/* @var $model Staff */
?>

<div class="text-right"><a href="" id="toggle-search">расширенный поиск</a></div>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('/staff/front/index'),
    'id' => 'search-form',
    'method' => 'get',
)); ?>

    <div class="search-min clearfix">
        <button type="submit" class="btn-default">Искать</button>
        <div>
            <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'placeholder' => 'Например, дизайнер')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('/staff/front/index'),
    'id' => 'search-form2',
    'method' => 'get',
)); ?>
    <div class="search-max">
        <div class="row">
            <label class="">Название</label>
            <?php echo $form->textField($model, 'title', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'organization'); ?>
            <?php echo $form->dropDownList($model, 'organization', array('' => 'Любой') + $orgs, array('class' => 'select')); ?>
            <?php echo $form->error($model, 'organization'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'group'); ?>
            <?php echo $form->dropDownList($model, 'group', array('' => 'Все') + VacancyGroup::instance()->list, array('class' => 'select')); ?>
            <?php echo $form->error($model, 'group'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'category'); ?>
            <?php echo $form->dropDownList($model, 'category', array('' => 'Любое') + VacancyCategory::instance()->list, array('class' => 'select')); ?>
            <?php echo $form->error($model, 'category'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'education_level'); ?>
            <?php echo $form->dropDownList($model, 'education_level', array('' => 'Любое') + EducationLevel::instance()->list, array('class' => 'select')); ?>
            <?php echo $form->error($model, 'education_level'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'education_direction'); ?>
            <?php echo $form->dropDownList($model, 'education_direction', array('' => 'Любое') + $directions, array('class' => 'select')); ?>
            <?php echo $form->error($model, 'education_direction'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'expirience'); ?>
            <?php echo $form->dropDownList($model, 'expirience', array('' => 'Любое') + ExperienceType::instance()->list, array('class' => 'select')); ?>
            <?php echo $form->error($model, 'expirience'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'amount_min'); ?>
            <?php echo $form->textField($model, 'amount_min', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'amount_min'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'amount_max'); ?>
            <?php echo $form->textField($model, 'amount_max', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'amount_max'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'contest_type'); ?>
            <?php echo $form->dropDownList($model, 'contest_type', array('' => 'Любой') + ContestType::instance()->list, array('class' => 'select')); ?>
            <?php echo $form->error($model, 'contest_type'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'contest_result'); ?>
            <?php echo $form->dropDownList($model, 'contest_result', array('' => 'Все') + ContestState::instance()->list, array('class' => 'select')); ?>
            <?php echo $form->error($model, 'contest_result'); ?>
        </div>
        <?php echo $form->hiddenField($model, 'search_date', array('class' => 'search_date')); ?>

        <div class="row">
            <?php echo CHtml::submitButton('Искать', array('class' => 'btn-default')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>
