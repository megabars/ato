<?php

Yii::app()->getModule('afisha');

class LatestEventsWidget extends CWidget
{
    /**
     * Количество записей
     * @var int
     */
    public $limit = 10;

    /**
     * Необходимая дата
     * @var string
     */
    public $date = null;
    /**
     * Необходимая дата
     * @var string
     */
    public $type = 'month';

    /**
     * На текущую дату
     * @var boolean
     */
    public $today = false;

    /**
     * Если нужен только список
     * @var boolean
     */
    public $partial = false;

    /**
     * Дает возможность называть виджет как угодно
     * @var string
     */
    public $name = null;


    public function run()
    {
        $criteria = new CDbCriteria();

        if ($time = strtotime($this->date))
        {
            $day = date('d', $time);
            $month = date('m', $time);
            $year = date('Y', $time);

            $start = strtotime("{$year}-{$month}-{$day} 00:00:00");
            $finish = strtotime("{$year}-{$month}-{$day} 23:59:59");
        }
        else
        {
           $time = time();
           $month = date('m', $time);
           $year = date('Y', $time);

           $start = strtotime("{$year}-{$month}-01 00:00:00");
           $finish = strtotime("{$year}-{$month}-".date("t",$time)." 23:59:59");

        }

        if($this->type=='month')
        {
            $m = array('.'=>" ",1=>"Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
            $this->date = str_replace($m, array_keys($m),$this->date);

            $time = strtotime($this->date);
            $month = date('m', $time);
            $year = date('Y', $time);

            $start = strtotime("{$year}-{$month}-01 00:00:00");
            $finish = strtotime("{$year}-{$month}-".date("t",$time)." 23:59:59");
        }
        elseif($this->type=='year')
        {
            $m = array('.'=>" ",1=>"Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
            $this->date = str_replace($m, array_keys($m),$this->date);
            $year = date('Y', strtotime($this->date));
            $start = strtotime("{$year}-01-01 00:00:00");
            $finish = strtotime(($year+1)."-01-01 00:00:00")-1;
        }

        $criteria->addBetweenCondition('date', $start, $finish);
        $criteria->order = 'date DESC';

        if($this->partial)
            $view = 'application.themes.tomsk.views.widgets.LatestEventsWidget._eventList';
        else
            $view = 'application.themes.tomsk.views.widgets.LatestEventsWidget.index';


        $model=new Afisha('search');
        $allRecords = Afisha::model()->published()->findAll($model->defaultScope());


        // собираем отформатированные даты опубликованных мероприятий в массив
        $datesArray = array();
        foreach($allRecords as $event)
            $datesArray[] = date('d.m.Y', $event->date);

        $datesArray = addslashes(CJSON::encode($datesArray));

        $files = AfishaConf::model()->find();

        $criteria->mergeWith($model->defaultScope());
        $model->unsetAttributes();
        $model->setDbCriteria($criteria);
        $model->setPageSize($this->limit);

        $this->render($view, array(
            'name' => $this->name,
            'datesArray' => $datesArray,
            'files' => $files,
            'records' => $model->published()->search(),
            'type' => $this->type
        ));


    }
}