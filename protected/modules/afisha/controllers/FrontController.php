<?php

class FrontController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionView($id)
    {
        if (!$record = Afisha::model()->published()->findByPk($id))
            $this->errorTo($this->createUrl('/afisha/front/index'), 'Мероприятие не найдено');

        $time = '';
        if(!empty($record->duration)) {
            $duration = $record->duration - $record->date;

            if($duration < 86400) {
                $time = new DateTime('@'.$duration);
            }
        }

        $this->render('view', array(
            'record' => $record,
            'time' => $time,

        ));
    }

    public function actionUpdateCalendar()
    {
        if(Yii::app()->request->isAjaxRequest){
            $this->renderPartial('calendar', array(
                'date' => @$_REQUEST['date'],
                'limit' => @$_REQUEST['limit'],
                'type' => @$_REQUEST['type'],
            ));
        } else
            $this->errorTo($this->createUrl('/afisha/front/index'), 'Ошибка');
    }
 }