<?php

class LocalController extends AdminController
{
    public function init()
    {
        $this->pageTitle = 'Местное самоуправление';

        $this->breadcrumbs = array(
            'Местное самоуправление'
        );

        return parent::init();
    }

    public function actionCreate()
    {
        $findModel = PeopleLocal::model()->findByAttributes(array('portal_id' => $this->portalId));

        $model = $findModel ? $findModel : new PeopleLocal();

        if (isset($_POST['PeopleLocal']))
        {
            $model->setAttributes($_POST['PeopleLocal'], false);

            if ($model->save())
                $this->noticeTo($this->createUrl('/people/local/create'), 'Данные успешно сохранены');
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
}