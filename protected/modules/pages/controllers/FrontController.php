<?php

class FrontController extends Controller
{
    public function actionIndex($url)
    {
//        Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false;

        $urlModel = UrlManager::model()->findByAttributes(array('url' => $url));

        // если статики с таким алиасом нет - пускаем модуль или контроллер
        if ($urlModel === null) {
            throw new CHttpException(404);
        }

//            if ($module = Yii::app()->findModule($url)) {
//                $controllerPath = "/{$module->id}/{$module->defaultController}";
//                $this->redirect($controllerPath);
//            }
//
//            Yii::app()->runController($url);
//            Yii::app()->end();



            $this->pageTitle = $urlModel->title;

            $cs = Yii::app()->clientScript;

            $cs->registerMetaTag($urlModel->meta_keywods, 'keywords');
            $cs->registerMetaTag($urlModel->meta_description, 'description');

            $page = StaticPage::model()->published()->findByAttributes(array('url_id' => $urlModel->id));

            if(!empty($page)) {
                if (empty($this->pageTitle))
                    $this->pageTitle = @$page->title;

                $nav = NavItems::model()->findByAttributes(array('url_id' => $urlModel->id));
                if ($nav !== null) {
                    $this->navigationItemId = $nav->id;

                    $this->breadcrumbs = $nav->breadcrumbs;
                }

                $view = 'index';

                // Выбираем вьюху в зависимости от типа страницы
                if($page->type_id == RecordType::ADM)
                    $view = 'adm';

                $this->render($view, array(
                    'page' => $page,
                ));
            } else {
                throw new CHttpException(404, 'Страница не существует');
            }
    }
}
