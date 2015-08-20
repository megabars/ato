<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Opendata('search');

        $model->unsetAttributes();

        if (isset($_GET['Opendata']))
        {
            $model->attributes = $_GET['Opendata'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Opendata();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Opendata']))
        {
            $model->attributes = $_POST['Opendata'];
            $model->date_init = strtotime($model->date_init);
            $model->date_last_change = strtotime($model->date_last_change);
            $model->date_actual = strtotime($model->date_actual);

            $transaction = Yii::app()->db->beginTransaction();

            $categories = $model->category;
            $model->category = '';
            $error = false;

            if ($model->save())
            {
                OpendataCategories::model()->deleteAllByAttributes(array('opendata_id' => $model->id));

                if (is_array($categories))
                {
                    foreach ($categories as $item)
                    {
                        $categoryModel = new OpendataCategories();
                        $categoryModel->opendata_id = $model->id;
                        $categoryModel->category_id = $item;

                        if ($categoryModel->save())
                        {
                            $error = true;
                        }
                    }
                }
            }

            if ($error)
            {
                $transaction->commit();

                $this->redirect(array('index'));
            }
            else
                $transaction->rollback();
        }

        $selectedCategory = array();
        foreach ($model->category_list as $item)
        {
            $selectedCategory[$item->category_id] = array('selected' => 'selected');
        }

        $this->render('create', array(
            'model' => $model,
            'selectedCategory' => $selectedCategory,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Opendata']))
        {
            $model->attributes = $_POST['Opendata'];
            $model->date_init = strtotime($model->date_init);
            $model->date_last_change = strtotime($model->date_last_change);
            $model->date_actual = strtotime($model->date_actual);

            $transaction = Yii::app()->db->beginTransaction();

            $categories = $model->category;
            $model->category = '';
            $error = false;

            if ($model->save())
            {
                OpendataCategories::model()->deleteAllByAttributes(array('opendata_id' => $model->id));

                if (is_array($categories))
                {
                    foreach ($categories as $item)
                    {
                        $categoryModel = new OpendataCategories();
                        $categoryModel->opendata_id = $model->id;
                        $categoryModel->category_id = $item;

                        if ($categoryModel->save())
                        {
                            $error = true;
                        }
                    }
                }
            }

            if ($error)
            {
                $transaction->commit();

                $this->redirect(array('index'));
            }
            else
                $transaction->rollback();
        }

        $selectedCategory = array();
        foreach ($model->category_list as $item)
        {
            $selectedCategory[$item->category_id] = array('selected' => 'selected');
        }

        $this->render('update', array(
            'model' => $model,
            'selectedCategory' => $selectedCategory,
        ));
    }

    public function actionSettings()
    {
        $model = OpendataSettings::model()->findByPk(1);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OpendataSettings']))
        {
            $model->attributes = $_POST['OpendataSettings'];

            if ($model->save())
            {
                $this->redirect(array('index'));
            }
        }

        $this->render('settings', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/opendata/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Opendata::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Opendata::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'opendata-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}