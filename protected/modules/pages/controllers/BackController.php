<?php

class BackController extends AdminController
{
    public function init()
    {
        parent::init();

        $clientScript = Yii::app()->getClientScript();

        $baseUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/../assets');

        $clientScript->registerScriptFile($baseUrl . '/js/back.js', CClientScript::POS_HEAD);
    }

    public function actionIndex($type = false)
    {
        $model = new StaticPage('search');
        $model->unsetAttributes();
        $model->type_id = $type;

        if (isset($_GET['StaticPage'])) {
            $model->attributes = $_GET['StaticPage'];
        }

        $this->render('index', array(
            'model' => $model->sorted()
        ));
    }

    /**
     * Создает главную страницу субпортала или перенаправляет на редактирование существующей
     */
    public function actionSubportalMain(){

        $url = UrlManager::model()->findByAttributes(array('url' => 'main-page'));

        if ($url === null) {
            $url = new UrlManager();
            $url->url = 'main-page';
            $url->title = 'Главная страница';

            if (!$url->save())
                throw new CHttpException(500, 'Cant save urs 4 main page. Errors: '.print_r($url->getErrors(), true));
        }

        $page = StaticPage::model()->findByAttributes(array('url_id'=> $url->id));

        // создаем страницу если нет такой
        if ($page == null) {
            $page = new StaticPage();
            $page->attributes = array(
                'title' => "Главная страница",
                'url_id' => $url->id,
                'state' => 1,
                'date' => date('Y-m-d H:m:s')
            );

            $page->type_id = RecordType::SUBPORTAL_MAIN;

            if (!$page->save())
                throw new CHttpException(500, 'Cant save static page, error is: '.print_r($page->getErrors(), true));

        }

        $this->redirect($this->createUrl('/pages/back/update', array('id' => $page->id, 'type' => $page->type_id)));
    }

    /**
     * Прицепить статическую страницу к существующему пункту меню
     */
    public function actionNavItem($itemId){

        $navItem = NavItems::model()->findByPk($itemId);

        if ($navItem == null)
            throw new CHttpException(500, 'Nav item not found');


        $page = StaticPage::model()->findByAttributes(array('url_id' => $navItem->url_id));

        if ($page === null) {
            $class = RecordType::instance()->class[RecordType::DEF];

            $page = new $class;
            $page->url_id = $navItem->url_id;
            $page->title = $navItem->title;
            $page->save();
        }

        $this->redirect($this->createUrl('/pages/back/update', array('type' => $page->type_id, 'id' => $page->id)));
    }


    public function actionCreate($type)
    {
        $class = RecordType::instance()->class[$type];

        /** @var $model StaticPage */
        $model = new $class;
        $model->title = 'Новая страница';
        $model->save();

        $this->redirect($this->createUrl('/pages/back/update', array('type' => $type, 'id' => $model->id)));
    }

    public function actionUpdate($type, $id)
    {
        $model = $this->loadModel($type, $id);

        if($type==RecordType::REGION)
            $model->setscenario('region');

        $redirect = $this->save($model);

        if(gettype($redirect)=='string') { //на случай, если будут ошибки валидации связанных таблиц
            $errors = json_decode($redirect);
            $output = CHtml::tag('ul', array(), '', false);
            foreach($errors as $error) {
                foreach ($error as $item)
                    $output .= CHtml::tag('li', array(), $item);
            }
            $output .= CHtml::closeTag('ul');
            $this->errorTo($this->createUrl('/pages/back/update', array('id'=>$id, 'type'=>$type)), $output);
        }

        if ($redirect) {

            if ($type == RecordType::DEF || $type == RecordType::ADM || $type == RecordType::REGION) {
                $menu = NavMenu::model()->findByAttributes(array('alias' => 'main_menu'));
                $this->redirect($this->createUrl('/navigation/back/index', array('id' => $menu->id)));
            } else {
                $this->redirect($this->createUrl('/pages/back/index', array('type' => $type)));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Фоновая фу-я сохранения статической страницы
     * @param $model
     * @return bool true если модель была изменена или сохранена
     * @throws CHttpException
     */
    protected function save($model){

        $class = get_class($model);

        $redirect = false;

        if (isset($_POST[$class])) {
            $model->attributes = $_POST[$class];

            if (!$model->save()) {
                throw new CHttpException(500, 'Cant save staticPage. Model error is:'.print_r($model->getErrors(), true));
            }  else {
                $nav = NavItems::model()->with('url')->findByAttributes(array('url_id' => $model->url_id));
                if($nav!=null) {
                    $nav->state = $model->state;
                    $nav->navItemUrl = $model->url->url;
                    $nav->save();
                }
                $redirect = true;
            }

        }

        // init & save page relations if need
        $initedRels = array('url', 'pageGallery', 'pageFolders', 'pageFacts', 'pageLinks', 'pageNews');

        foreach ($model->relations() as $rel => $descr) {
            if (!in_array($rel, $initedRels))
                continue;

            list($relType, $class, $relField) = $descr;

            // init relations if null
            if ($model->$rel === null) {
                $model->$rel = new $class();
            }

            // save relations if have POST data
            if (isset($_POST[$class])) {
                $model->$rel->attributes = $_POST[$class];

                if($rel=='url' && $model->$rel->url == null && $model->external_link == null) {
                    $url = Transliterate::text($model->title);
                    $url = preg_replace('/\W/s', '-', trim($url));
                    $model->$rel->url = strtolower($url);
                }

                if ($model->$rel->save()) {
                    $model->$relField = $model->$rel->id;
                    $model->save();

                    // refresh не подходит тк сбрасывает в null ранее созданные relation's
                    //$model->refresh();
                    $model->$rel = $model->$rel;
                } else {
                    if($rel=='url') {
                        $redirect = false;
                        break;
                    } else
                        return json_encode($model->$rel->getErrors());
                }
            }
        }

        return $redirect;

    }

    public function actionDelete($type, $id)
    {
        $this->loadModel($type, $id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $this->createUrl('/pages/back', array('type' => $type)));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                StaticPage::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    /**
     * @param $type
     * @param $id
     * @return Page
     * @throws CHttpException
     */
    public function loadModel($type, $id)
    {
        $modelName = RecordType::instance()->class[$type];
        $model = $modelName::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }
}