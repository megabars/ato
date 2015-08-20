<?php

class SubscribeController extends AdminController
{
    public $group;
    public $subscribes=array();

    public function beforeAction($action)
    {
        $groups = Yii::app()->mailchimp->listGroups();

        if(!empty($groups))
            foreach($groups as $group)
                if(!empty($_GET['groups_id'])) {
                    if ($group['id'] == $_GET['groups_id'])
                        $this->group = $group;
                }else{
                    $this->group = $group;
                    break;
                }


        $subscribes = Yii::app()->mailchimp->listMembers();
        if(!empty($subscribes))
            foreach($subscribes as $s)
                if($s['merges']['GROUPINGS'])
                    foreach($s['merges']['GROUPINGS'] as $g)
                        if($g['id']==$this->group['id'])
                            if($g['groups'])
                                foreach($g['groups'] as $gs)
                                {
                                    if($gs['interested'])
                                        $this->subscribes[]=array(
                                            'id'=>@$s['web_id'],
                                            'email'=>@$s['merges']['EMAIL'],
                                            'first_name'=>@$s['merges']['FNAME'],
                                            'last_name'=>@$s['merges']['LNAME'],
                                        );
                                    break;
                                }


        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->render('index', array(
            'model' =>  $this->subscribes,
        ));
    }

    public function actionCreate()
    {
        $model = new Subscribe;

        // $this->performAjaxValidation($model);

        if (isset($_POST['Subscribe']))
        {
            $model->setAttributes($_POST['Subscribe'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['Subscribe']))
        {
            $model->setAttributes($_POST['Subscribe'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/subscribe/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Subscribe::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Subscribe::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'subscribe-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
