<?php

/**
 * Class FrontController
 * @var $model StaticPage
 */

class FrontController extends Controller
{
    public $staticPage;

    public function init()
    {
        parent::init();

        $this->staticPage = UrlManager::getAppealPage();

        $this->registerModuleAssetsScripts(array(), array('front.css')); //todo временно. нужно будет смержить с основными стилями
    }

    public function actionIndex()
    {
        $this->render('index', array(
            'page' => $this->staticPage
        ));
    }

    public function actionNew()
    {
        $this->render('new');
    }

    public function actionStatus()
    {
        if(Yii::app()->request->isAjaxRequest) {
            $url = 'http://appeals.tomsk.gov.ru/appeals/'.$_POST['code'];
            $html = file_get_contents($url);
            preg_match( '/<h3>(.*?)<\/h3>/is' , $html , $message );

            echo $message[1];

            Yii::app()->end();
        }

        $this->render('status');
    }

    public function actionSchedule()
    {
        // показываем график приема на 2 месяца вперед
        $criteria = new CDbCriteria();
        if($this->portalId == 1) {
            $start = strtotime(date('Y-m-1'));
            $end = $start + 60 * 24 * 3600;
            $criteria->addBetweenCondition('date', $start, $end);
        }

        $data = new CActiveDataProvider('AppealSchedule', array(
            'criteria'=>$criteria,
        ));

        $this->render('schedule', array(
            'data'=> $data,
        ));
    }

    public function actionPlace()
    {
        $this->render('place', array(
            'items'=> AppealPlace::model()->findAll(),
        ));
    }

    public function actionDocuments()
    {
        $this->render('documents', array(
            'pageFolders' => $this->staticPage->pageFolders
        ));
    }

    public function actionReview($id=null)
    {
        if($id) {
            $model= AppealReview::model()->findByPk($id);
        } else {
            $model= AppealReview::model()->find(new CDbCriteria(array('order' => 'year desc')));
        }

        if ($model === null)
            $model = new AppealReview();

        $years = CHtml::listData(AppealReview::model()->findAll(),'id', 'year');

        $this->render('review', array(
            'years' => $years,
            'model'=> $model,
        ));
    }
}