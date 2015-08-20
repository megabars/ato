<?php

class PageNewsController extends AdminController
{
    public function actionSave($id=null, $type=null)
    {
        if($id == null) {
            $model = new News;
            if (isset($_POST['News'])) {
                $model->setAttributes($_POST['News'], false);

                if(!$model->save()) {
                    throw new CHttpException(500, 'Ссылка не создана');
                } else {
                    $count = News::model()->count('type=:type', array('type'=>$model->type));
                    echo $count;
                }
            } else {
                $model->type = $type;
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);

            if (isset($_POST['News'])){
                $model->setAttributes($_POST['News'], false);
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
            $count = News::model()->count('type=:type', array('type'=>$model->type));
            echo $count;
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/news/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        $type = '';
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                $model = $this->loadModel($id);
                $type = $model->type;
                $model->delete();
            }
        }

        if($type) {
            $count = News::model()->count('type=:type', array('type'=>$type));
            echo $count;
        }
    }

    public function actionGridUpdate($type, $limit = null)
    {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        $this->renderPartial('index', array('type' => $type, 'limit' => $limit), false, true);
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

    protected  function getForm($model) {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        $this->renderPartial('_form', array('model' => $model), false, true);
    }
}