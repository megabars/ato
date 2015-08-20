<?php

class PageFactsController extends AdminController
{
    public function actionIndex()
    {
        $model = new PageFacts('search');

        $model->unsetAttributes();

        if (isset($_GET['PageFacts']))
            $model->attributes = $_GET['PageFacts'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate($pageId = null)
    {
        Yii::app()->getClientScript()->scriptMap = array('*.js' => false, '*.css' => false);

        $model = new PageFacts;
        $model->page_id = $pageId;

        // $this->performAjaxValidation($model);

        if (isset($_POST['PageFacts']))
        {
            $model->setAttributes($_POST['PageFacts'], false);

            if(!$model->save()) {
                throw new CHttpException(500, 'Факт не создан');
            }

        }

        $this->renderPartial('_form', array('model' => $model), false, true);
    }

    public function actionUpdate($id)
    {
        Yii::app()->getClientScript()->scriptMap = array('*.js' => false, '*.css' => false);
        $model = $this->loadModel($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['PageFacts']))
        {
            $model->setAttributes($_POST['PageFacts'], false);

            if(!$model->save()) {
                throw new CHttpException(500, 'Факт не изменен');
            }
        }

        $this->renderPartial('_form', array('model' => $model), false, true);
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/pagefacts/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                PageFacts::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = PageFacts::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pagefacts-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
