<?php

class FrontController extends Controller
{

    public function init()
    {
        parent::init();
    }
    /**
     * @todo не убираю не нужные $pages (категории новостей в админке) чтоб не сломалось все, $pages и категории новостей убить
     */
    public function actionIndex($dateBegin = null, $dateEnd = null, $search = null)
    {
        $criteria = new CDbCriteria();

        if(!empty($_GET['type']))
            if($type = NewsType::model()->findByPk((int)$_GET['type']))
                $criteria->compare('type',$type->id);

        if($dateBegin && $timeDateBegin = strtotime($dateBegin))
        {
            $startDay = date('d', $timeDateBegin);
            $startMonth = date('m', $timeDateBegin);
            $startYear = date('Y', $timeDateBegin);

            $timeDateBegin = strtotime("{$startDay}-{$startMonth}-{$startYear} 00:00:00");

            $criteria->addCondition("t.date >= {$timeDateBegin}");
        }

        if($dateEnd && $timeDateEnd = strtotime($dateEnd))
        {
            $endDay = date('d', $timeDateEnd);
            $endMonth = date('m', $timeDateEnd);
            $endYear = date('Y', $timeDateEnd);

            $timeDateEnd = strtotime("{$endDay}-{$endMonth}-{$endYear} 23:59:59");

            $criteria->addCondition("t.date <= {$timeDateEnd}");
        }


        if($search)
        {
            $search = trim($search);
            $criteriaSearch = new CDbCriteria();
            $criteriaSearch->addSearchCondition('t.description', $search , true, 'OR', 'ILIKE');
            $criteriaSearch->addSearchCondition('t.preview', $search , true, 'OR', 'ILIKE');
            $criteriaSearch->addSearchCondition('t.title', $search , true, 'OR', 'ILIKE');

            $criteriaSearch->with = array('url');
            $criteriaSearch->together = false;
            $criteriaSearch->addSearchCondition('url.meta_keywods', $search, true, 'OR', 'ILIKE');
            $criteriaSearch->addSearchCondition('url.meta_description', $search, true, 'OR', 'ILIKE');
            $criteriaSearch->addSearchCondition('url.title', $search, true, 'OR', 'ILIKE');



            $criteria->mergeWith($criteriaSearch, 'AND');
        }



        $count = News::model()->published()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $records = News::model()->sorted()->published()->findAll($criteria);

        $this->render('index', array(
            'records' => $records,
            'pages' => $pages,
            'dateBegin' => $dateBegin,
            'dateEnd' => $dateEnd,
            'search' => $search,
        ));
    }

    public function actionView($id)
    {
        if (!$record = News::model()->resetScope()->findByPk($id)) {
            $this->errorTo('/news/front/index', 'Новость не найдена');
        }

        $this->render('view', array(
            'record' => $record,
        ));
    }

    public function actionSubscribe()
    {
        $model = new SubscribeForm();

        $this->performAjaxValidation($model);

        if (isset($_POST['SubscribeForm'])) {
            $model->attributes = $_POST['SubscribeForm'];

            if ($model->validate()) {
                $newsSubscribers = new NewsSubscribers();
                $newsSubscribers->attributes = $model->attributes;

                $url = Yii::app()->request->urlReferrer;

                if ($newsSubscribers->validate()) {
                    if ($newsSubscribers->save()) {
                        $this->noticeTo($url, 'Спасибо, ваша подписка оформлена');
                    }
                } else {
                    $error = $newsSubscribers->errors;
                    $this->errorTo($url, $error['email'][0]);
                }
            }
        }

        $this->renderPartial('_subscribe_form', array(
            'model' => $model,
        ),false, true);
    }

    /*
     * use link "/news/front/unSubscribe/{$id}"
     */
    public function actionUnSubscribe($id)
    {
        if(NewsSubscribers::model()->deleteByPk($id))
            $this->noticeTo('/news/front', 'Ваш E-mail удален из списка рассылки');
        else
            $this->errorTo('/news/front', 'Ваш E-mail не был удален из списка рассылки. Обратитесь к администратору');
    }

    public function actionRss(){
        Yii::import('ext.feed.*');

        header('Content-Type: application/rss+xml; charset=UTF-8');

        // specify feed type
        $feed = new EFeed(EFeed::RSS1);
        $feed->title = 'Официальный портал исполнительных органов государственной власти Томской области';
        $feed->link = $this->createAbsoluteUrl('/');
        $feed->description = 'Новости официального портала ИОГВ Томской областм';

        foreach (News::model()->sorted()->published()->limit(50)->findAll() as $news) {
            // create our item
            $item = $feed->createNewItem();
            $item->title = $news->title;
            $item->link = $this->createAbsoluteUrl('/news/front/view', array('id' => $news->id));
            $item->date = strtotime($news->date);
            $item->description = $news->description;

            if ($news->url !== null && $news->url->meta_keywods !== null)
                $item->addTag('dc:subject', $news->url->meta_keywods);

            $feed->addItem($item);
        }

        foreach (Yii::app()->log->routes as $route)
        {
                $route->enabled = false;
        }

        if (News::model()->sorted()->published()->limit(50)->count() > 0)
            $feed->generateFeed();
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-subscribers-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}