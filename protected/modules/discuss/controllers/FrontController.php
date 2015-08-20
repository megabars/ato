<?php

class FrontController extends Controller
{
    public function init()
    {
        parent::init();
//        $this->navigationItemId = 1610;
//        $navItem = NavItems::model()->with('url')->findByPk($this->navigationItemId);
//        $this->breadcrumbs = $navItem->getBreadcrumbs();

    }

    public function actionIndex($view = 'index')
    {
        $model = new Discuss('search');

        $model->unsetAttributes();
        if (isset($_GET['Discuss']))
        {
            $model->attributes = $_GET['Discuss'];
        }

        $additionalCriteria = new CDbCriteria();

        if (!empty($_GET['Discuss']['date_finish']) && $_GET['Discuss']['date_finish'] == 1)
        {
            $additionalCriteria->addCondition('date_finish < ' . time());
        }
        else
        {
            $additionalCriteria->addCondition('date_finish > ' . time());
        }

        $this->render($view, array(
            'additionalCriteria' => $additionalCriteria,
            'model' => $model,
        ));
    }

    public function actionArchive(){
        $this->actionIndex('archive');
    }

    public function actionView($id)
    {
        $model = Discuss::model()->findByPk($id);

        $this->render('view', array(
            'model' => $model,
            'file' => File::model()->findByPk($model->file),
        ));
    }
}