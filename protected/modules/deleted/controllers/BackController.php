<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $modules = Log::getModules();

        $panels = array();
        foreach($modules as $module)
            $panels[$module['name']] = $this->renderPartial('_list', array('models' =>$module['models'], 'moduleName' => $module['name']), true, false);

        ksort($panels);

        $this->render('index', array(
            'panels' => $panels,
        ));
    }

    public function actionView($name, $title)
    {
        $this->pageTitle = $title;
        $model = new $name('search');

        $model->unsetAttributes();

        if ($model instanceof Event)
            $model->type_id = RecordType::EVENT;
        elseif ($model instanceof Stenogramm)
            $model->type_id = RecordType::VERB_REPORT;

        if (isset($_GET[$name])){
            $model->attributes = $_GET[$name];
            if(isset($model->date))
                $model->date = strtotime($_GET[$name]['date']);
        }

        $model->removed();

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionRestore($name, $id)
    {
        $model = $this->loadModel($name, $id);

        $model->is_deleted = BaseActiveRecord::STATUS_DEFAULT;

        if (!$model->save())
            throw new CHttpException(500, 'Не удалось восстановить');

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/deleted/back/index'));
    }

    public function actionDelete($name, $id)
    {
        $model = $name::model()->removed()->realDeleteByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной записи не существует.');

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/deleted/back/index'));
    }

    public function actionDeleteAll($name)
    {
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                $name::model()->removed()->realDeleteByPk($id);
            }
        }
        echo json_encode(true);
    }

    public function actionRestoreAll($name)
    {
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                $model = $this->loadModel($name, $id);
                $model->is_deleted = BaseActiveRecord::STATUS_DEFAULT;
                $model->save();
            }
        }
        echo json_encode(true);
    }

    public function loadModel($name, $id)
    {
        $model = $name::model()->removed()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной записи не существует.');

        return $model;
    }
}