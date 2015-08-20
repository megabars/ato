<?php

class FrontController extends Controller
{
    public function init()
    {
        $this->registerModuleAssetsScripts(array('script.js'), array());
        parent::init();
    }

    public function actionIndex($state = null)
    {
        $model = new Staff('search');

        $model->unsetAttributes();

        if (isset($_GET['Staff']))
        {
            $model->attributes = $_GET['Staff'];
        }

        if ($state)
            $model->state = $state;

        $criteria = new CDbCriteria();
        $criteria->order = 'title asc';
        $criteria->join = 'INNER JOIN staff ON staff.portal_id = t.id';

        switch ($state)
        {
            case 2:
                $title = 'Итоги конкурсов';
                break;
            case -1:
                $title = 'Архив конкурсов';
                break;
            default:
                $title = 'Все';
                break;
        }

        $this->render('index', array(
            'model' => $model,
            'time' => time(),
            'portals' => Portal::model()->findAll($criteria),
            'directions' => Staff::getPossibleDirections(),
            'orgs' => Staff::getPossibleOrganization(),
            'state' => $state,
            'title' => $title,
        ));
    }

    public function actionView($id)
    {
        $model = Staff::model()->findByPk($id);

        $this->render('view', array(
            'model' => $model
        ));
    }
}