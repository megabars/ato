<div class="form" style="width: 450px">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'feedback-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone'); ?>
        <?php echo $form->textField($model, 'phone'); ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text'); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'attachment'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'attachment', 'isImage' => true)); ?>
        <?php echo $form->error($model, 'attachment'); ?>
    </div>


    <div class="row button">
        <button type="submit" class="btn">Отправить</button>
    </div>

    <?php $this->endWidget(); ?>
</div>