<?php

class FrontController extends Controller
{
    public $itemMenu;
    public function __construct($id, $module = null)
    {
        return parent::__construct($id, $module);
    }

    public function actionIndex($type = 1)
    {
        $menu_id = NavMenu::model()->find('portal_id=' . Yii::app()->controller->portalId)->id;

        $this->itemMenu = NavItems::model()->find('"menuId"='. $menu_id .' and title LIKE \'%Оценка регулирующего воздействия%\'')->id;


        if (!$type)
            $type = 1;

        $criteria = new CDbCriteria();
        $isProject = in_array($type, RatingGlobalType::instance()->listProjectIds);
        $showFilter = in_array($type, $this->getTypesWithFilter());

        $count = RatingDoc::model()->getByType($type)->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);

        $dataProvider = new RatingDoc('search');
        $dataProvider->unsetAttributes();

        if (isset($_GET['RatingDoc']))
        {
            $dataProvider->attributes = $_GET['RatingDoc'];
        }

        $this->render('index',array(
            'dataProvider' => $dataProvider->getByType($type),
            'type' => $type,
            'pages' => $pages,
            'isProject' => $isProject,
            'name' => RatingGlobalType::instance()->listCommon[$type],
            'showFilter' => $showFilter,
            'parent_id' => $this->itemMenu
        ));
    }

    public function actionFeedback()
    {
        $menu_id = NavMenu::model()->find('portal_id=' . Yii::app()->controller->portalId)->id;

        $this->itemMenu = NavItems::model()->find('"menuId"='. $menu_id .' and title LIKE \'%Оценка регулирующего воздействия%\'')->id;

        $model = new RatingFeedback();
        if (isset($_POST['RatingFeedback']))
        {
            $model->attributes = $_POST['RatingFeedback'];
            if ($model->validate()) {
                if ($model->save()) {
                    $this->noticeTo('/rating/front/feedback', "Подписка на уведомления о проведении ОРВ и экспертиз успешно оформлена!");
                } else {
                    $this->errorTo('/rating/front/feedback', "Не удалось оформить подписку. Пожалуйста, попробуйте позднее");
                }
            }
        }
        $this->render('feedback', array(
            'model' => $model,
            'parent_id' => $this->itemMenu
        ));
    }

    public function getTypesWithFilter() {
        return array(

            RatingGlobalType::GLOBAL_TYPE_INFO,
            RatingGlobalType::GLOBAL_TYPE_CONCLUSION,
            RatingGlobalType::GLOBAL_TYPE_MONITORING,
            RatingGlobalType::GLOBAL_TYPE_EXPERT_PLAN,
            RatingGlobalType::GLOBAL_TYPE_PROJECT,
            RatingGlobalType::GLOBAL_TYPE_PROJECT_EXPERT,
        );
    }
}