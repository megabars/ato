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
    public function actionIndex($dateBegin = null, $dateEnd = null)
    {
        $criteria = new CDbCriteria();
        $count = News::model()->published()->count($criteria);

        if(!empty($_GET['type']))
            if($type = NewsType::model()->findByPk((int)$_GET['type']))
                $criteria->compare('type',$type->id);

        if(!empty($_GET['dateBegin']) && !empty($_GET['dateEnd']))
            $criteria->condition = "date >= '". strtotime($dateBegin) ."' AND date<= '". strtotime($dateEnd) ."'";


        $pages = new CPagination($count);
        $pages->pageSize = 6;
        $pages->applyLimit($criteria);

        $records = News::model()->sorted()->published()->findAll($criteria);

        $this->render('index', array(
            'records' => $records,
            'pages' => $pages,
        ));
    }

    public function actionView($id)
    {
        if (!$record = News::model()->findByPk($id))
            $this->errorTo('/news', 'Новость не найдена');

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

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-subscribers-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}