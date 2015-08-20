<?php

use \Facebook\FacebookSession;
use \Facebook\FacebookRequest;
use \Facebook\FacebookRedirectLoginHelper;

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new News('search');

        $model->unsetAttributes();

        /**
         * Зачем это нужно?
         * Cкорее всего задумывалось как распределение по админам.
         */
//        if(!UserModule::isAdmin())
//            $model->author = Yii::app()->user->id;

        if (isset($_GET['News']))
        {
            $model->attributes = $_GET['News'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new News();
        $model->title = 'Новая новость';
        $model->save();

        $this->redirect($this->createUrl('/news/back/update', array('id' => $model->id)));

//        $model = new News;
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if (isset($_POST['News']))
//        {
//            $model->setAttributes($_POST['News'], false);
//            $model->author = Yii::app()->user->id;
//
//            if ($model->save())
//            {
//                $this->redirect(array('index'));
//            }
//        }
//
//
//        $this->render('create', array(
//            'model' => $model,
//        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['News']))
        {
            $model->setAttributes($_POST['News'], false);
            $model->author = Yii::app()->user->id;

            if ($model->save())
            {
                /*
                if ($model->state == 1)
                {
                    $this->twitterPost($model);

                    $this->facebookPost($model->id);
                }
*/
                $this->redirect('/index');
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/news/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                News::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = News::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    /**
     * Публикация новости в twitter
     * @param $model
     */
    protected function twitterPost($model)
    {
        $connection = new TwitterOAuth('I3H2r3wLt9bLvSecRRrvpCimu', 'c1TnzkPPVaWWDr9AuOe9Y26GPDaJDLgrzam6LAAuvX3MEZfLeO',
            '3187174623-RdjtIHllLH1mruE9mjCVk8KO8sEHa5HEJmIFMRs', '77d6ZixLhlsoJ02geKFHjgBqR30PeHYPLKPP8ycG5KUY4');

        $connection->get('/account/verify_credentials');
        $connection->post('statuses/update', array('status' => strip_tags($model->description)));
    }

    /**
     * Публикация новости в facebook
     */
    public function actionFacebookPost()
    {
        if (($newsId = Yii::app()->session->get('fb_news_id', null)) && $model = News::model()->findByPk($newsId))
        {
            $helper = $this->facebookHelper();

            try
            {
                $session = $helper->getSessionFromRedirect();

                $link = $this->createAbsoluteUrl('/news/front/view', array('id' => $newsId));

                // Публикация новости на своей страничке
                $request = new FacebookRequest($session, 'POST', '/me/feed', array('message' => strip_tags($model->description), 'link' => $link));

                $request->execute()->getGraphObject()->getProperty('id');
            }
            catch(FacebookRequestException $ex)
            {
//                echo "Exception occured, code: " . $ex->getCode();
//                echo " with message: " . $ex->getMessage();
            }
            catch(\Exception $ex)
            {
//                echo $ex->getMessage();
            }
        }

        $this->redirect('index');
    }

    /**
     * Формирует ссылку для аутентификации и редиректит на нее. Затем facebook отправит нас на actionFacebookPost
     * @param $id
     */
    public function facebookPost($id)
    {
        Yii::app()->session->add('fb_news_id', $id);

        $helper = $this->facebookHelper();

        $this->redirect($helper->getLoginUrl(array(
            'user_birthday,user_religion_politics,user_relationships,user_relationship_details,user_hometown,
            user_location,user_likes,user_education_history,user_work_history,user_website,user_groups,
            user_managed_groups,user_events,user_photos,user_videos,user_friends,user_about_me,user_status,user_games_activity,
            user_tagged_places,user_posts,read_stream,read_mailbox,read_page_mailboxes,rsvp_event,email,ads_management,
            ads_read,read_insights,manage_notifications,manage_pages,publish_pages,publish_actions,read_custom_friendlists,
            user_actions.books,user_actions.music,user_actions.video,user_actions.news,user_actions.fitness,public_profile'
        )));
    }

    /**
     * Получение Хелпера
     * @return FacebookRedirectLoginHelper
     */
    public function facebookHelper()
    {
        $sdkpath = Yii::app()->basePath . '/extensions/facebook-sdk';
        require_once($sdkpath . '/autoload.php');

        FacebookSession::setDefaultApplication('969850573039255', 'ff0af6ffd9aad21c368a26b9b2dc997a');

        $helper = new FacebookRedirectLoginHelper($this->createAbsoluteUrl('/news/back/FacebookPost'));

        return $helper;
    }
}