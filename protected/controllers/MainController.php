<?php

class MainController extends Controller
{
    public $mainPage = true;

    public function actionIndex()
    {
        $this->breadcrumbs = array();

        // блок события региона
        $events = Event::model()->sorted()->published()->limit(4)->findAll();

        // вкладочка новости
        $newsCriteria = News::model()->sorted()->published()->limit(6)->getDbCriteria();
        $news = new CActiveDataProvider('News', array('criteria' => $newsCriteria));
        $news->setPagination(false);

        // публикации в сми
        $smi = Smi::model()->sorted()->published()->limit(6)->findAll();

        $mainPage = StaticPage::model()->with('url')->find("url.url = 'main-page' and t.type_id =". RecordType::SUBPORTAL_MAIN);
        
        $this->render('index', array(
            'mainPage' => $mainPage,
            'events' => $events,
            'news' => $news,
            'smi' => $smi
        ));
    }

    public function actionError()
    {
        $this->layout = '//layouts/error';
        //VarDumper::dump(Yii::app()->errorHandler->error);
        if ($error = Yii::app()->errorHandler->error)
            $this->render('error', $error);
    }

    //
    public function actionWork()
    {
        $this->layout = '//layouts/error';

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($this->assetsBase . '/js/jquery.countdown.js');

        $this->render('working');
    }


    public function actionSiteMap()
    {
        $this->render('application.themes.tomsk.views.main.site_map');
    }



    /*
    * Переключение на версию для слабовидящих
    */
    public function actionThemes($theme = false)
    {
        Yii::app()->session['invalid'] = $theme;

        if(Yii::app()->session['fontsize'] == null) {
            Yii::app()->session['fontsize'] = 'small';
        }

        if(Yii::app()->session['themecolor'] == null) {
            Yii::app()->session['themecolor'] = 'white';
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionFonts($fontsize = 'small')
    {
        Yii::app()->session['fontsize'] = $fontsize;
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionColor($themecolor = 'white')
    {
        Yii::app()->session['themecolor'] = $themecolor;
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionYandex()
    {
        $this->renderPartial('application.themes.tomsk.views.main._yandexMaps');
    }

//    public function actionAAA()
//    {
//        foreach (Opendata::model()->findAll() as $opendata)
//        {
//            $filePath = File::model()->getFilePath($opendata->file);
//
//            if (file_exists($filePath))
//            {
//                $content = file_get_contents($filePath);
//
//                $content = str_replace(';', ',', $content);
//
////                $content = iconv('cp1251', 'utf-8', $content);
//
//                file_put_contents($filePath, $content);
//            }
//        }
//    }
}