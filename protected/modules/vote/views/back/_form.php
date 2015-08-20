<?php
Yii::app()->clientScript->registerScript('init_addItems',"
    var i = 0;

    $('.add-item').click(function (e) {
        e.preventDefault();

        i--;
        var item = $(this).closest('tr');

        item.after(item.next().clone()).next().val('').find('input[type=text]').val('').attr('name', 'Vote[voteItems][' + i + ']');

        return false;
    });

    $('.form-vote-block').on('click', '.delete-item', function (e) {
        e.preventDefault();

        $(this).closest('.vote-qestion-item-block').remove();
    });"
);
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'vote-form',
        'enableAjaxValidation' => false,
    )); ?>

        <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'finish'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'finish',
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'finish'); ?>
        </div>

        <div class="row checkbox-list">
            <?php echo $form->checkBox($model, 'state'); ?>
            <?php echo $form->labelEx($model, 'state'); ?>
            <?php echo $form->error($model, 'state'); ?>
        </div>

        <div class="row checkbox-list">
            <?php echo $form->checkBox($model, 'closed'); ?>
            <?php echo $form->labelEx($model, 'closed'); ?>
            <?php echo $form->error($model, 'closed'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'date_publish'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'date_publish',
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'date_publish'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

        <div class="row">
            <div class="form-vote-block">

                <table>
                    <tr>
                        <td colspan="2">
                            <a href="#" class="add-item">Добавить</a>
                        </td>
                    </tr>

                    <?php
                        echo $this->renderPartial('_item', array('id' => 0, 'title' => ''), false);

                        foreach ($model->voteItems as $key => $item)
                        {
                            if (!empty($item))
                                echo $this->renderPartial('_item', array('id' => $key, 'title' => $item), false);
                        }

//                        foreach ($model->items as $item)
//                        {
//                            if (!empty($item))
//                                echo $this->renderPartial('_item', array('id' => $item->id, 'title' => $item->title), false);
//                        }
                    ?>
                </table>
            </div>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
        </div>

    <?php $this->endWidget(); ?>

</div>