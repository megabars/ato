<?php

class BackController extends AdminController
{

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($type)
    {
        $model=new RatingDoc();
        $isProject = in_array($type, RatingGlobalType::instance()->listProjectIds);

        if ($isProject && !isset($_POST['RatingProjectFile'])) {
            $files = RatingDefaultFile::instance()->list[$type];
            foreach ($files as $file) {
                $f = new RatingProjectFile();
                $f->setAttributes($file, false);
                $model->addRelatedRecord('files', $f, count($model->files));
            }
        }

        if(isset($_POST['RatingDoc']))
        {
            $model->attributes = $_POST['RatingDoc'];
            $model->global_type = $type;

            $isFileError = false;
            $filesPost = array();
            if (isset($_POST['RatingDoc']['files'])) {
                foreach ($_POST['RatingDoc']['files'] as $num => $file) {
                    if (isset($file['file']) && strlen($file['file']) > 0 ) {
                        $f = new RatingProjectFile();

                        $f->attributes = $file;
                        if (!$f->validate()) {
                            $isFileError = true;
                        }
                        $filesPost[] = $f;
                    }
                }
                $model->files = $filesPost;
            }

            $model->date = isset($model->date) ? strtotime($model->date) : 0;
            if(!$isFileError && $model->save()){
                if (isset($model->files)){
                    foreach ($model->files as $file){
                        $file->project_id = $model->id;
                        $file->save();
                    }
                }

                $this->redirect(array('index?type='.$type));
            }

        }

        $this->render('create', array(
            'render'    => $this->getRenderFile($type),
            'model' => $model,
            'type'  => $type,
            'types' => RatingLocalType::instance()->list[$type],
            'name' => RatingGlobalType::instance()->listCommon[$type],
            'isProject' => $isProject,
        ));
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id)->with('files');
        $type = $model->global_type;
        $isProject = in_array($type, RatingGlobalType::instance()->listProjectIds);

        if(isset($_POST['RatingDoc']))
        {
            $model->attributes = $_POST['RatingDoc'];
            $model->global_type = $type;

            $isFileError = false;
            $filesPost = array();
            if (isset($_POST['RatingDoc']['files'])) {
                foreach ($_POST['RatingDoc']['files'] as $num => $file) {
                    $f = RatingProjectFile::model()->findByPk($num);
                    $f->attributes = $file;
                    if (!$f->validate())
                        $isFileError = true;
                    $filesPost[] = $f;
                }
                $model->files = $filesPost;
            }

            $model->date = (isset($model->date) && isset($_POST['RatingDoc']['date'])) ? strtotime($model->date) : 0;
            if(!$isFileError && $model->save()) {
                if (isset($model->files)) {
                    foreach ($model->files as $file) {
                        $file->project_id = $model->id;
                        $file->save();
                    }
                }
            }
        }

        $this->render('update', array(
            'render'    => $this->getRenderFile($type),
            'model' => $model,
            'type'  => $type,
            'types' => RatingLocalType::instance()->list[$type],
            'name' => RatingGlobalType::instance()->listCommon[$type],
            'isProject' => $isProject,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($type = 0)
    {
        if (!$type)
            $type = RatingGlobalType::GLOBAL_TYPE_INFO;

        $isProject = in_array($type, RatingGlobalType::instance()->listProjectIds);
        $dataProvider = new RatingDoc('search');
        $dataProvider = $dataProvider->getByType($type);
        $name = RatingGlobalType::instance()->listCommon[$type];

        $this->render('index',array(
            'type' => $type,
            'name' => $name,
            'model' => $dataProvider,
            'isProject' => $isProject,
        ));
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Contest the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {

        $model = RatingDoc::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Contest $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='contest-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getRenderFile($type)
    {
        $render = array(
            RatingGlobalType::GLOBAL_TYPE_INFO           => '_info',
            RatingGlobalType::GLOBAL_TYPE_CONCLUSION     => '_defaultWithType',
            RatingGlobalType::GLOBAL_TYPE_MONITORING     => '_default',
            RatingGlobalType::GLOBAL_TYPE_EXPERT_PLAN    => '_defaultWithType',

            RatingGlobalType::GLOBAL_TYPE_PROJECT        => '_project',
            RatingGlobalType::GLOBAL_TYPE_PROJECT_EXPERT => '_projectExpert',
        );
        return $render[$type];
    }

}