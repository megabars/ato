<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Links('search');
        $model->unsetAttributes();

        FileUpload::registerScripts();
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');


        // в самом модуле енадо выводить только ссылки с главное страницы
        $linksGroup = LinksGroup::model()->findByAttributes(array('alias' => 'main'));
        if ($linksGroup !== null)
            $model->group_id = $linksGroup->id;
        else
        {
            $linksGroup = new LinksGroup();
            $linksGroup->alias = 'main';
            $linksGroup->validate();

            $linksGroup->save();

            $model->group_id = $linksGroup->id;
        }

        if (isset($_GET['Links']))
        {
            $model->attributes = $_GET['Links'];
        }

        $this->render('index', array(
            'model' => $model,
            'groupId' => $linksGroup->id
        ));
    }

    public function actionSave($id=null, $group_id=null)
    {
        if($id == null) {
            $model = new Links;
            if (isset($_POST['Links'])) {
                $model->setAttributes($_POST['Links'], false);

                if(!$model->save()) {
                    throw new CHttpException(500, 'Ссылка не создана');
                } else {
                    $count = Links::model()->count('group_id=:group_id', array('group_id'=>$model->group_id));
                    echo $count;
                }
            } else {
                $model->group_id = $group_id;
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);

            if (isset($_POST['Links'])){
                $model->setAttributes($_POST['Links'], false);
                $model->save();

            } else { // отдаем заполненную форму
                $this->getForm($model);
            }
        }
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        if($model->delete()) {
            $count = Links::model()->count('group_id=:group_id', array('group_id'=>$model->group_id));
            echo $count;
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/links/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        $group_id = '';
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                $model = $this->loadModel($id);
                $group_id = $model->group_id;
                $model->delete();
            }
        }

        if($group_id) {
            $count = Links::model()->count('group_id=:group_id', array('group_id'=>$group_id));
            echo $count;
        }
    }

    public function actionGridUpdate($groupId, $limit = null)
    {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        $this->renderPartial('index', array('groupId' => $groupId, 'limit' => $limit), false, true);
    }

    public function actionSort()
    {
        if (isset($_POST['items']) && is_array($_POST['items'])) {
            $i = 1;
            foreach ($_POST['items'] as $item) {
                $model = $this->loadModel($item);
                $model->ordi = $i;
                $model->save();
                $i++;
            }
        }
    }

    public function loadModel($id)
    {
        $model = Links::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'links-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    protected  function getForm($model) {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        $this->renderPartial('_form', array('model' => $model), false, true);
    }
}