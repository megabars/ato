<?php

Yii::app()->getModule('afisha');

class LatestEventsWidget extends CWidget
{
    /**
     * Количество записей
     * @var int
     */
    public $limit = 0;

    /**
     * Необходимая дата
     * @var string
     */
    public $date = null;

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

    public function run()
    {

        $criteria = new CDbCriteria();

        if ($this->date)
        {
            if ($this->date == -1)
            {
                $time = time();

                $criteria->addCondition("date < {$time}");
                $criteria->order = 'date DESC';
            }
            elseif ($time = strtotime($this->date))
            {
                $day = date('d', $time);
                $month = date('m', $time);
                $year = date('Y', $time);

                $start = strtotime("{$year}-{$month}-{$day} 00:00:00");
                $dayCount = date('t', $start);
                $finish = strtotime("{$year}-{$month}-{$day} 23:59:59");

                $criteria->addBetweenCondition('date', $start, $finish);
            }
        }

        $count = Afisha::model()->published()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        if($this->limit > 0)
            $criteria->limit = $this->limit;

        $records = Afisha::model()->sorted('ASC')->published()->findAll($criteria);

        if($this->partial) {
            $view = 'application.themes.tomsk.views.widgets.LatestEventsWidget._eventList';
        } else {

            $view = 'application.themes.tomsk.views.widgets.LatestEventsWidget.index';
        }

        $allRecords = Afisha::model()->sorted('ASC')->published()->findAll();

        // собираем отформатированные даты опубликованных мероприятий в массив
        $datesArray = array();
        foreach($allRecords as $event) {
            $datesArray[] = date('d.m.Y', $event->date);
        }
        $datesArray = addslashes(CJSON::encode($datesArray));

        $files = AfishaConf::model()->findByPk(1);

        $this->render($view, array(
            'limit' => $this->limit,
            'datesArray' => $datesArray,
            'records' => $records,
            'pages' => $pages,
            'files' => $files,
        ));


    }
}