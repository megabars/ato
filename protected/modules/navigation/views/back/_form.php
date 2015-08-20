<?php
/* @var $this AdminController */
/* @var $model Navigation */
/* @var $form CActiveForm */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'navigation-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/navigation/back/save/id/'.$model->id.'/menuId/'.$model->menuId.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#navigation_dialog").dialog("close");
                            $("#navigation-list").addClass("loader");
                            window.location.reload();
                        }
                    });
                    return false;
                }
            }')

    )); ?>

        <?php echo $form->errorSummary($model); ?>

    <?php if (Yii::app()->getModule('navigation')->allowMenuTypes): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'menuId'); ?>
            <?php echo $form->dropDownList($model, 'menuId', CHtml::listData(NavMenu::model()->findAll(), 'id', 'alias'), array('id'=>'menuItem')); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <div id="rootItems">
                <?php echo $rootItems; ?>
            </div>
        </div>
    <?php endif; ?>

        <div class="row" <?php echo $model->isNewRecord? 'id="entry"': '' ?>>
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
        <?php echo $form->hiddenField($model, 'url_id'); ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'navItemUrl'); ?>
            <?php echo $form->textField($model, 'navItemUrl', array('size' => 60, 'maxlength' => 500, 'value' => @$model->url->url)); ?>
            <?php echo $form->error($model, 'navItemUrl'); ?>
        </div>

        <div class="row">
            <div class="checkbox-list">
                <?php echo $form->checkBox($model, 'state', array('checked'=>'true')); ?>
                <?php echo $form->labelEx($model, 'state', array('style' => 'display: inline;')); ?>
                <?php echo $form->error($model, 'state'); ?>
            </div>
        </div>
        <div class="row">
            <div class="checkbox-list">
                <?php echo $form->checkBox($model, 'is_link'); ?>
                <?php echo $form->labelEx($model, 'is_link', array('style' => 'display: inline;')); ?>
                <?php echo $form->error($model, 'is_link'); ?>
            </div>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>
<script>
    $(document).ready(function(){
        $('#menuItem').on('change', function(){
            $('#navigation-form').addClass('loader');
            $.ajax({
                url: '/navigation/back/rootItems/id/<?php echo $model->id; ?>/menuId/'+$(this).val(),
                type: 'POST',
                success: function(data) {
                    $('#rootItems').html(data);
                    $('#navigation-form').removeClass('loader');
                },
                cache: false
            });
        })
    });
</script>