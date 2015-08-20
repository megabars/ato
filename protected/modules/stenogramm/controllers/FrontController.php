<?php

class FrontController extends Controller
{

    public function init()
    {
        parent::init();
    }

    public function actionIndex($dateBegin = null, $dateEnd = null)
    {
        $criteria = new CDbCriteria();

        if(!empty($_GET['dateBegin']) && !empty($_GET['dateEnd']))
            $criteria->condition = "date >= '". strtotime($dateBegin) ."' AND date<= '". strtotime($dateEnd) ."'";

        $records = Stenogramm::model()->sorted()->published()->findAll($criteria);

        $pages = new CPagination(count($records));
        $pages->pageSize = 6;
        $pages->applyLimit($criteria);

        $this->render('index', array(
            'records' => $records,
            'pages' => $pages,
        ));
    }

    public function actionView($id)
    {
        if (!$record = Stenogramm::model()->findByPk($id))
            $this->errorTo('/stenogramm', 'Стенограмма не найдена');

        $this->render('view', array(
            'record' => $record,
        ));
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'stenogramm-subscribers-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}