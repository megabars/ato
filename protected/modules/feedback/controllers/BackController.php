<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Feedback('search');

        $model->unsetAttributes();

        if (isset($_GET['Feedback']))
            $model->attributes = $_GET['Feedback'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionView($id)
    {
        if (!$record = Feedback::model()->findByPk($id)) {
            $this->errorTo('/feedback/back', 'Запись не найдена');
        }
        else {
            $record->new = 0;
            $record->save();
        }

        $this->render('view', array(
            'record' => $record,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/feedback/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Feedback::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Feedback::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

}