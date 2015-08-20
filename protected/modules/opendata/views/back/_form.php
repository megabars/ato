<?php
/* @var $this AdminController */
/* @var $model Opendata */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'opendata-form',
        'enableAjaxValidation' => false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'portal_id'); ?>
            <?php echo $form->dropDownList($model, 'portal_id', CHtml::listData(Portal::model()->findAll(), 'id', 'title')); ?>
            <?php echo $form->error($model, 'portal_id'); ?>
        </div>

        <div class="row">
            <label>Категория (можно выбрать несколько)</label>
            <div class="checkbox-list fixed">
                <?php echo CHtml::checkBoxList('Opendata[category][]',
                    array_keys(CHtml::listData($model->categories, 'category_id' , 'category_id')),
                    CHtml::listData(OpendataCategory::model()->findAll(), 'id', 'title')); ?>
            </div>
            <?php echo $form->error($model, 'category'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'file'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'file', 'isImage' => false, 'config' => array('allowedExtensions' => array('csv')))); ?>
            <?php echo $form->error($model, 'file'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'structure_file'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'structure_file', 'isImage' => false, 'config' => array('allowedExtensions' => array('csv')))); ?>
            <?php echo $form->error($model, 'structure_file'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'identifier'); ?>
            <?php echo $form->textField($model, 'identifier', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'identifier'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('size' => 60)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'period'); ?>
<!--            --><?php //echo $form->textField($model, 'period', array('size' => 60, 'maxlength' => 255)); ?>
<!--            --><?php //echo $form->error($model, 'period'); ?>
<!--        </div>-->

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'owner'); ?>
<!--            --><?php //echo $form->textField($model, 'owner', array('size' => 60, 'maxlength' => 255)); ?>
<!--            --><?php //echo $form->error($model, 'owner'); ?>
<!--        </div>-->

        <div class="row">
            <?php echo $form->labelEx($model, 'responsible'); ?>
            <?php echo $form->textField($model, 'responsible', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'responsible'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'phone'); ?>
            <?php echo $form->textField($model, 'phone', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'phone'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'link'); ?>
<!--            --><?php //echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 255)); ?>
<!--            --><?php //echo $form->error($model, 'link'); ?>
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'format'); ?>
<!--            --><?php //echo $form->textField($model, 'format', array('size' => 60, 'maxlength' => 255)); ?>
<!--            --><?php //echo $form->error($model, 'format'); ?>
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'structure'); ?>
<!--            --><?php //echo $form->textField($model, 'structure', array('size' => 60, 'maxlength' => 255)); ?>
<!--            --><?php //echo $form->error($model, 'structure'); ?>
<!--        </div>-->

        <div class="row">
            <?php echo $form->labelEx($model, 'date_init'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'Opendata[date_init]',
                'value' => $model->date_init ? date('d-m-Y H:i', $model->date_init) : '',
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'date_init'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'date_last_change'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'Opendata[date_last_change]',
                'value' => $model->date_last_change ? date('d-m-Y H:i', $model->date_last_change) : '',
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'date_last_change'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'last_content'); ?>
            <?php echo $form->textField($model, 'last_content', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'last_content'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'date_actual'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'Opendata[date_actual]',
                'value' => $model->date_actual ? date('d-m-Y H:i', $model->date_actual) : '',
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'date_actual'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'keyword'); ?>
            <?php echo $form->textField($model, 'keyword', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'keyword'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'link_version'); ?>
<!--            --><?php //echo $form->textField($model, 'link_version', array('size' => 60, 'maxlength' => 255)); ?>
<!--            --><?php //echo $form->error($model, 'link_version'); ?>
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'link_version_struct'); ?>
<!--            --><?php //echo $form->textField($model, 'link_version_struct', array('size' => 60, 'maxlength' => 255)); ?>
<!--            --><?php //echo $form->error($model, 'link_version_struct'); ?>
<!--        </div>-->

        <div class="row">
            <?php echo $form->labelEx($model, 'version'); ?>
            <?php echo $form->textField($model, 'version', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'version'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>