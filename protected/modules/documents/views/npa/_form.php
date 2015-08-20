<?php
/* @var $this EditionItemController */
/* @var $model EditionItem */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'npa-form',
    'enableAjaxValidation' => false,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/documents/npa/save/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#npa_dialog").dialog("close");
                            $.fn.yiiGridView.update("npa-grid");
                        }
                    });
                    return false;
                }
            }')
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'executive_id'); ?>
        <?php echo $form->dropDownList($model, 'executive_id', CHtml::listData(Executive::model()->sorted()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'executive_id'); ?>
    </div>

    <?php if(!empty($groupId)): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'folder_id'); ?>
            <?php echo $form->dropDownList($model, 'folder_id', CHtml::listData(DocumentsFolder::model()->findAllByAttributes(array('group_id' => $groupId)), 'id', 'title')); ?>
            <?php echo $form->error($model, 'folder_id'); ?>
        </div>
    <?php else: ?>
        <?php echo $form->hiddenField($model, 'folder_id', array('value'=>$folderId)); ?>
    <?php endif ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'number'); ?>
        <?php echo $form->textField($model, 'number', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'number'); ?>
    </div>

<!--    <div class="row">-->
<!--        --><?php //echo $form->labelEx($model, 'public'); ?>
<!--        --><?php //echo $form->textField($model, 'public', array('size' => 60, 'maxlength' => 255)); ?>
<!--        --><?php //echo $form->error($model, 'public'); ?>
<!--    </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'date_real'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'Documents[date_real]',
            'value' => $model->date_real ? date('Y-m-d H:i', $model->date_real) : '',
            'mode' => 'datetime',
            'options'=>array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_real'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_public'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'name' => 'Documents[date_public]',
            'value' => $model->date_public ? date('Y-m-d H:i', $model->date_public) : '',
            'mode' => 'datetime',
            'options'=>array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date_public'); ?>
    </div>

<?php echo $form->error($model, 'date'); ?>

    <?php echo $form->hiddenField($model, 'file', array('value'=>0)); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'pdf'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'pdf',
            'allowedExtensions' => array('pdf'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploaderPdf')
            )); ?>
        <?php echo $form->error($model, 'pdf'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'doc'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'doc',
            'allowedExtensions' => array('doc', 'docx', 'xls', 'xlsx'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploaderDoc')
            )); ?>
        <?php echo $form->error($model, 'doc'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'zip'); ?>
        <?php $this->widget('FileUpload', array(
            'model' => $model,
            'attribute' => 'zip',
            'allowedExtensions' => array('zip', 'zipx', 'rar', '7z', 'arj'),
            'isImage' => false,
            'htmlOptions' => array('id' => 'documentUploaderZip')
            )); ?>
        <?php echo $form->error($model, 'zip'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'preview'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'preview')); ?>
        <?php echo $form->error($model, 'preview'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'note'); ?>
        <?php echo $form->textField($model, 'note', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'note'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
    </div>

<?php $this->endWidget(); ?>
