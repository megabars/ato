<?php

class BackController extends AdminController
{
    public function init()
    {
//        ini_set('max_input_vars', 3000);

        parent::init();

        $clientScript = Yii::app()->getClientScript();

        $baseUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/../assets');

        $clientScript->registerCssFile($baseUrl . '/css/back.css');
        $clientScript->registerCoreScript('jquery.ui');
        $clientScript->registerScriptFile($baseUrl . '/js/jquery.mjs.nestedSortable.js', CClientScript::POS_HEAD);
        $clientScript->registerScriptFile($baseUrl . '/js/back.js', CClientScript::POS_HEAD);
    }

    public function actionIndex($id = null, $alias = null)
    {
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');

        if ($id === null) {
            $menu = NavMenu::model()->findByAttributes(array('alias' => $alias));
            if ($menu !== null)
                $id = $menu->id;
            else
                throw new CHttpException(404, 'Главное меню портала не найдено');
        }

        $this->render('index', array(
            'menuId' => $id
        ));
    }

    public function actionList()
    {
        $this->renderPartial('_list', true, false);
    }

    public function actionSave($id=null, $menuId=null)
    {
        if($id == null && $menuId != null) {
            $model = new NavItems();
            $model->menuId = $menuId;
            $model->setScenario('in_structure');
        } else {
            $model = $this->loadModel($id);
        }

        if (isset($_POST['NavItems'])){
            $model->setAttributes($_POST['NavItems'], false);
            $model->navItemUrl = $_POST['NavItems']['navItemUrl'];

            $url = modelFactory::get('UrlManager', array('id' => (int)$model->url_id));
            $url->url = $model->navItemUrl;

            $this->performAjaxValidation($model);

            $url->save();
            $model->url_id = $url->id;

            if (!$model->save())
                throw new CHttpException(500, 'Errors: '.print_r($model->getErrors(), true));
            else {
                $page = StaticPage::model()->with('url')->findByAttributes(array('url_id' => $model->url_id));
                if($page!=null) {
                    $page->state = $model->state;
                    $page->save();
                }
            }
        } else { // отдаем заполненную форму
            $this->getForm($model);
        }
    }

    protected  function getForm($model) {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        $this->renderPartial('_form', array(
            'model' => $model,
            'rootItems' => $this->getRootItems($model->id, $model->menuId),
            ), false, true
        );
    }

    public function actionRootItems($id, $menuId)
    {
        echo $this->getRootItems($id, $menuId);
    }

    protected function getRootItems($id, $menuId)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('"t"."menuId"', $menuId);

        $selected = 0;

        if ($id != null) {
            $criteria->addCondition('t.id != :tid');
            $criteria->params[':tid'] = $id;
            $selected = NavItems::model()->findByPk($id)->parent_id;
        } else {
            $criteria->compare('parent_id', 0);
        }

        $rootItems = CHtml::listData(NavItems::model()->sorted()->findAll($criteria), 'id', 'title');

        return CHtml::dropDownList('NavItems[parent_id]', $selected, array('0'=>'Без родительского элемента')+ $rootItems);

    }

    public function actionSort()
    {
        if (isset($_POST['data']))
        {
            $success = false;
            $items = json_decode($_POST['data']);

            foreach ($items as $item)
            {
                if ($model = NavItems::model()->with('url')->findByPk($item->id))
                {
                    $model->parent_id = (int)$item->parent_id;
                    $model->ordi = (int)$item->ordi;
                    $model->state = (int)$item->state;
                    $model->navItemUrl = @$model->url->url;

                    if($model->save()) {
                        $success = true;
                    }
                }
            }
            echo $success;
        }
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $menuId = $model->menu->id;

        $model->delete();

        if (!isset($_GET['ajax']))
        {
            $url = isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $this->createUrl('/navigation/back/index', array('id' => $menuId));
            $this->redirect($url);
        }
    }

    public function loadModel($id)
    {
        $model = NavItems::model()->findByPk($id);
        $model->setScenario('in_structure');

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'navigation-form')
        {
            $result = CActiveForm::validate($model);
            echo $result;

            Yii::app()->end();
        }
    }
}