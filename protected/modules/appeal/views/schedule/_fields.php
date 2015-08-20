    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'date',
            'mode' => 'date',
            'options'=>array(
                'dateFormat' => 'dd.mm.yy',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>