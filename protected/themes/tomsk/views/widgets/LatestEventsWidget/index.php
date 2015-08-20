<?php
/** @var $records Afisha */
/** @var $files AfishaConf */
Yii::app()->clientScript->registerScript("datesArray", 'datesArray = jQuery.parseJSON("' . $datesArray . '");');
Yii::app()->clientScript->registerScript("limit", 'limit = '. (int)@$this->limit . ';');
?>

<script>
    $(function(){
        $(".getMounth").click(function(){
            $.ajax({
                url: "/afisha/front/updateCalendar",
                type: "post",
                data: {
                    "date":$("#justmonday").val(),
                    "type":"month"
                },
                success:function(data){
                    $(".calendar-table").html(data);
                }
            });
            return false;
        });
        $(".getYear").click(function(){
            $.ajax({
                url: "/afisha/front/updateCalendar",
                type: "post",
                data: {
                    "date":$("#justmonday").val(),
                    "type":"year"
                },
                success:function(data){
                    $(".calendar-table").html(data);
                }
            });
            return false;
        });
    })
</script>
<div class="calendar-block">
    <div class="calendar">
        <div class="head">
            <a href="<?php echo Yii::app()->controller->createUrl('/afisha/front'); ?>">
                <?php echo ($name === null) ? Yii::t('app', 'Календарь мероприятий') : $name; ?>
            </a>
        </div>
        <div class="dates">
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>'justmonday',
                'flat'=>true,
                'language'=>'ru',
                'options'=>array(
                    'showOtherMonths'=>true,
                    'showOtherDay'=>true,
                    'showAnim'=>'drop',
                    'dateFormat' => 'dd.mm.yy',
                    'altFormat'=>'dd MM yy',
                    'onSelect'=>'js:function(date) {
                        $.ajax({
                            url: "/afisha/front/updateCalendar",
                            type: "post",
                            data: {
                                "date":date,
                                "type":"day"
                            },
                            success:function(data){
                                $(".calendar-table").html(data);
                            }
                        });
                    }',
                    'beforeShowDay'=> 'js:function(date){
                        return (datesArray.indexOf($.datepicker.formatDate("dd.mm.yy", date)) != -1) ? [true, ""] : [false, ""];
                    }'
                )
            ));?>
        </div>
        <div class="foot">
            План
            <a href="<?php echo (isset($files->month_file)) ? Yii::app()->controller->createUrl('/files/front/download', array('id' => $files->month_file)) : ''; ?>" class="getMounth"><?php echo Yii::t('app', 'на месяц'); ?></a>
            <a href="<?php echo (isset($files->year_file)) ? Yii::app()->controller->createUrl('/files/front/download', array('id' => $files->year_file)) : ''; ?>" class="getYear"><?php echo Yii::t('app', 'на год'); ?></a>
        </div>
    </div>
    <div class="calendar-table">
        <?php
        $this->render('application.themes.tomsk.views.widgets.LatestEventsWidget._eventList', array(
            'name' => $name,
            'records' => $records,
            'limit' => $this->limit,
            'type' => $this->type,
        )); ?>
    </div>
</div>

