<?php

Yii::app()->getModule('comments');

class FrontController extends Controller
{
    public $user_ip_address;

    public function init()
    {
        parent::init();

        $this->user_ip_address = @$_SERVER['REMOTE_ADDR'];

        $this->registerModuleAssetsScripts(array(), array('vote.css'));
    }


    public function actionIndex($type = 1)
    {
        $criteria = new CDbCriteria();

        if ($type == 1)
            $criteria->addCondition('finish > ' . time());
        elseif ($type == 2)
        {
            $criteria->addCondition('finish < ' . time());
        }

        $count = Vote::model()->published()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 4;
        $pages->applyLimit($criteria);

        $last = Vote::model()->sorted()->published()->limit(1)->find();

        if($pages->getCurrentPage() == 0 && $last !== null) {
            $criteria->addCondition('id!='.$last->id);
        }

        $this->render('index', array(
            'records' => Vote::model()->with(array('answersCount', 'items', 'items.answersCount'))->sorted()->published()->findAll($criteria),
            'pages' => $pages,
            'type' => $type,
            'last' => $last,
        ));
    }

    public function actionView($id)
    {
        $record = Vote::model()->published()->findByPk($id);

        if ($record === null)
            $this->errorTo('/vote/front/index', 'Опрос не найден');

        $this->render('view', array(
            'record' => $record,
        ));
    }

    public function actionSave()
    {
        if (!empty($_POST['vote_id']) && !empty($_POST['vote']))
        {
            if (!$vote = Vote::model()->findByPk($_POST['vote_id']))
                $this->errorTo('/vote/front', 'Выберите существующий опрос');

            if (!$voteItem = VoteItem::model()->findByPk($_POST['vote']))
                $this->errorTo('/vote/front', 'Выберите существующий вариант ответа');

            if (VoteUser::model()->countByAttributes(array('vote_id' => $vote->id, 'ip_address' => $this->user_ip_address)))
                $this->errorTo('/vote/front', 'Вы уже голосовали');

            $model = new VoteUser();
            $model->vote_id = $_POST['vote_id'];
            $model->vote_item_id = $_POST['vote'];
            $model->ip_address = $this->user_ip_address;

            if ($model->save())
                $this->noticeTo('/vote/front', 'Спасибо за ваш голос');
        }

        $this->errorTo('/vote/front', 'Не удалось проголосовать, повторите попытку позже');
    }
}
