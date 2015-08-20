    <div class="row">
        <?php echo $form->labelEx($model, 'time_start'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'mode'=>'time',
            'attribute' => 'time_start',
            'options'=>array(
                'dateFormat' => 'dd.mm.yy',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'time_start'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'time_end'); ?>
        <?php
        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model,
            'mode'=>'time',
            'attribute' => 'time_end',
            'options'=>array(
                'dateFormat' => 'dd.mm.yy',
                'timeFormat' => 'hh:mm',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'time_end'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'week_days'); ?>
        <?php foreach(AppealSchedule::$days as $key => $day): ?>
        <div class="checkbox-list">
            <input type="checkbox" name="AppealSchedule[days][]" <?php if(isset($model->week_days) && array_search(($key), $model->week_days) !== false) echo 'checked';  ?> id="day_<?php echo $key; ?>" value="<?php echo $key; ?>">
            <label for="day_<?php echo $key; ?>"><?php echo $day; ?></label>
        </div>
        <?php endforeach; ?>
        <?php echo $form->error($model, 'week_days'); ?>
    </div>