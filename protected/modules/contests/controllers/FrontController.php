<?php

class FrontController extends Controller
{
    public function init()
    {
        parent::init();

        $this->registerModuleAssetsScripts(array('script.js'), array());
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $count = Contest::model()->opened()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);

        $dataProvider = new Contest('search');
        $this->render('index', array(
            'records' => $dataProvider->opened(),
            'pages' => $pages,
        ));
    }
    public function actionResults($month = -1)
    {
        $criteria = new CDbCriteria();
        if ($month > 0) {
            $criteria->addCondition(
                'date_end >= :min_date AND date_end < :max_date'
            );
            $criteria->params = array(
                    'min_date' => mktime(0, 0, 0, $month, 1, date('Y')),
                    'max_date' => mktime(0, 0, 0, $month + 1, 1, date('Y')),
                );
        }
        $count = Contest::model()->closed()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);

        $dataProvider = new Contest('search');
        $criteria->mergeWith($dataProvider->getDbCriteria());

        $this->render('results', array(
            'records' => $dataProvider->closed(),
            'pages' => $pages,
            'month' => $month
        ));
    }

    public function actionArchive($year = -1, $month = -1)
    {
        $criteria = new CDbCriteria();
        if ($year > 0) {
            $max_month = ($month == -1) ? 12 : $month+1;
            $min_month = ($month == -1) ? 1 : $month;

            $max_year = ($month == -1) ? $year : $year + 1;

            $criteria->condition = 'date_end >= :min_date AND date_end < :max_date';
            $criteria->params = array(
                    'min_date' => mktime(0, 0, 0, $min_month, 1, $year),
                    'max_date' => mktime(0, 0, 0, $max_month, 1, $max_year),
                );
        }
        $count = Contest::model()->archived()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);

        $dataProvider = new Contest('search');

        $criteria->mergeWith($dataProvider->getDbCriteria());
        $this->render('archive', array(
            'records' => $dataProvider->archived(),
            'pages' => $pages,
            'year' => $year,
            'month' => $month
        ));
    }

    public function actionView($id)
    {
        $this->render('view', array(
            'model' => Contest::model()->findByPk($id)
        ));
    }
}