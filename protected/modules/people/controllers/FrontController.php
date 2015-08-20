<?php

class FrontController extends Controller
{
	public $type = People::TYPE_DUMA;

	public $middleBreadcrumbs = null;

	public function init()
	{
		parent::init();

        // попытаемся построить хлебные крошки для страницы, есл и она есть в меню
        $navItem = NavItems::model()->with('url')->find('url.url = :requestUrl', array(
            ':requestUrl' => 'people/front/index'));

        if ($navItem !== null) {
            $this->navigationItemId = $navItem->id;
            $this->breadcrumbs = $navItem->getBreadcrumbs();
        }
		if(in_array((int)@$_GET['type'],array_keys(People::getTypeLabels())))
			$this->type = (int)@$_GET['type'];
		$this->registerModuleAssetsScripts(array(), array('front.css')); //todo временно. нужно будет смержить с основными стилями
	}

	public function actionIndex()
	{
		$model = People::model()->find("type=".People::GOVERNOR);
		if(!Yii::app()->controller->isMainPortal())
		{
			$model = People::model()->find("type=".People::IOGV);
			$this->type = People::IOGV;
		}

        $this->render('index', array(
            'model' => $model,
        ));
	}

    public function actionView($id, $from = '')
    {
		$this->completeBreadcrumbs($from);
        $model = People::model()->findByPk($id);
        if(empty($model->main_info))
        {
            if(!empty($model->life))
                $this->redirect('/people/front/life/id/'.$model->id.'/from/'.$from);

            if(!empty($model->staff))
                $this->redirect('/people/front/staff/id/'.$model->id.'/from/'.$from);
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }

	public function actionLife($id=0, $from = '')
	{
		$this->completeBreadcrumbs($from);
		if(!$model=People::model()->findByPk($id))
			$model=People::model()->find();
		$this->render('life',array('model'=>$model));
	}
	public function actionStaff($id=0, $from = '')
	{
		$this->completeBreadcrumbs($from);
		if(!$model=People::model()->findByPk($id))
			$model=People::model()->find();
		$this->render('staff',array('model'=>$model));
	}

	public function actionUnit($id=0, $from = '')
	{
		$this->completeBreadcrumbs($from);
		if(!$model=People::model()->findByPk($id))
			$model=People::model()->find();
		$this->render('unit',array('model'=>$model));
	}
	public function actionContacts($id=0, $from = '')
	{
		$this->completeBreadcrumbs($from);
		if(!$model=People::model()->findByPk($id))
			$model=People::model()->find();
		$this->render('contacts',array('model'=>$model));
	}

	public function actionZam($id=0, $from = '')
	{
		$this->completeBreadcrumbs($from);
		if(!$model=People::model()->findByPk($id))
			$model=People::model()->find();
		$zams = People::model()->findAll('type >'.People::GOVERNOR.' AND type<'.People::LAW_CHILD);
		$this->render('zam',array('model'=>$model,'zams'=>$zams));
	}

	public function actionMaps()
	{
		$this->render('maps');
	}

	public function actionDuma()
	{
		$model=People::model()->find('type='.People::TYPE_DUMA);
		$this->redirect('/people/front/view/id/'.@$model->id.'/type/'.People::TYPE_DUMA);

	}

	public function actionGuber()
	{
		$this->breadcrumbs = array();
		$model=People::model()->find('type='.People::GOVERNOR);
		$this->render('index',array('model'=>$model));
	}

	public function actionLaw()
	{
		$this->breadcrumbs = array('Органы власти' => '/ORGANY-VLASTI', 'Судебная власть');
		$models=People::model()->findAll('type in ('.implode(",",array_keys(People::getTypeGroupLabels(People::LAW))).')');
		$this->render('table',array('models'=>$models));
	}

	public function actionAudit()
	{
		$model=People::model()->find('type='.People::TYPE_AUDIT);
		$this->redirect('/people/front/view/id/'.@$model->id.'/type/'.People::TYPE_AUDIT);
	}


	public function actionTerr()
	{
		$this->breadcrumbs = array('Органы власти' => '/ORGANY-VLASTI', 'Территориальные органы федеральных органов власти');
		$models=People::model()->findAll('type in ('.implode(',',array_keys(People::getTypeGroupLabels(People::TERR))).')');
		$this->render('table',array('models'=>$models));
	}

	public function actionIzber()
	{
		$model=People::model()->find('type='.People::TYPE_IZBER);
		$this->redirect('/people/front/view/id/'.@$model->id.'/type/'.People::TYPE_IZBER);
	}

	public function actionPredstavitel()
	{
		$model=People::model()->find('type='.People::TYPE_SOVET_FED);
		$this->redirect('/people/front/life/id/'.@$model->id);
	}

	public function actionLaws() // removed
	{
		$models=People::model()->findAll('type in('.People::LAW_CHILD.','.People::LAW_MAN.','.People::LAW_BUSINESSMAN.")");
		$this->breadcrumbs = array('Органы власти' => '/ORGANY-VLASTI', 'Уполномоченные по защите прав');
		$this->render('list',array('models'=>$models));
	}

	public function actionUpol()
	{
		$models=People::model()->findAll('type in('.People::LAW_CHILD.','.People::LAW_MAN.','.People::LAW_BUSINESSMAN.")");
		$this->pageTitle = 'Уполномоченные по защите прав';
		$this->breadcrumbs = array('Органы власти' => '/ORGANY-VLASTI', 'Уполномоченные по защите прав');
		$this->render('list',array('models'=>$models));
	}

	public function actionGovernment()
	{
		$this->render('government');
	}

	public function actionStructure()
	{
		$model = People::model()->findAll('type >'.People::GOVERNOR.' AND type<'.People::LAW_CHILD);

        $power = array();
        foreach(People::getTypeGroupLabels(People::POWER) as $k=>$p)
            $power[$k] = array('name'=>$p,'models'=>People::model()->findAll('type='.$k));

        foreach(People::getTypeGroupLabels(People::OTHER_POWER) as $k=>$p)
            $power[$k] = array('name'=>$p,'models'=>People::model()->findAll('type='.$k));


		$this->render('structure',array('model'=>$model,'power'=>$power));
	}

	public function actionAdministration()
	{
		$administration = People::model()->find("type=".People::GOVERNOR);
        $criteria = new CDbCriteria();
        $criteria->addInCondition('type',array_keys(People::getTypeGroupLabels(People::GOVERNOR)));
        $criteria->addNotInCondition("type",array(People::GOVERNOR,People::LAW_CHILD,People::LAW_BUSINESSMAN,People::LAW_MAN,People::TYPE_SOVET_FED));
		$models = People::model()->findAll($criteria);

		$this->render('administration',array('administration'=>$administration,'models'=>$models));
	}

	public function actionIogv()
	{
		$model = People::model()->find('type='.People::IOGV);
        $criteria = new CDbCriteria();
        $criteria->addCondition('type='.People::IOGV);
        $criteria->order = 'id asc';
		$models = People::model()->findAll($criteria);
		$this->type = People::IOGV;
		$this->render('iogv',array('models'=>$models,'model'=>$model));
	}

	public function actionExpert()
	{
		$model = People::model()->find('type='.People::EXPERT);
        $criteria = new CDbCriteria();
        $criteria->addCondition('type='.People::EXPERT);
        $criteria->order = 'id asc';
		$models = People::model()->findAll($criteria);
		$this->type = People::EXPERT;
		$this->render('iogv',array('models'=>$models,'model'=>$model));
	}

	public function actionCommittee()
	{
		$models=People::model()->findAll('type in('.implode(",",array(People::IOGV_COMMITTEE,People::IOGV_DEP)).")");
		$this->pageTitle = 'Структурные подразделения';
//		$this->breadcrumbs = array($this->pageTitle);
		$this->render('list_committee',array('models'=>$models));
	}


    public function actionTerro()
    {
        $this->type = People::IOGV_TERR_O;
//        $this->breadcrumbs = array(People::getTypeLabels($this->type));
        $models=People::model()->findAll('type='.$this->type);
        $this->render('table',array('models'=>$models));
    }
    public function actionCoord()
    {
        $this->type = People::IOGV_COORD;
//        $this->breadcrumbs = array(People::getTypeLabels($this->type));
        $models=People::model()->findAll('type='.$this->type);
        $this->render('table',array('models'=>$models));
    }
    public function actionDepo()
    {
        $this->type = People::IOGV_DEP_O;
//        $this->breadcrumbs = array(People::getTypeLabels($this->type));
        $models=People::model()->findAll('type='.$this->type);
        $this->render('table',array('models'=>$models));
    }
    public function actionProf()
    {
        $this->type = People::IOGV_PROF;
//        $this->breadcrumbs = array(People::getTypeLabels($this->type));
        $models=People::model()->findAll('type='.$this->type);
        $this->render('table',array('models'=>$models));
    }

	protected function completeBreadcrumbs($from){
		if($from=='maps')
			$this->middleBreadcrumbs = array(
				'Местное самоуправление' => $this->createUrl('/people/front/maps'),
			);
		if($from=='structure')
			$this->middleBreadcrumbs = array(
				'Исполнительные органы государственной власти' => $this->createUrl('/people/front/government'),
				'Структура исполнительных органов государственной власти Томской области' => $this->createUrl('/people/front/structure'),
			);
		if($from=='administration')
			$this->middleBreadcrumbs = array(
				'Исполнительные органы государственной власти' => $this->createUrl('/people/front/government'),
				'Структура исполнительных органов государственной власти Томской области в разрезе курирующих заместителей Губернатора Томской области' => $this->createUrl('/people/front/administration'),
			);
		if($from=='upol')
			$this->middleBreadcrumbs = array(
				'Уполномоченные по защите прав' => $this->createUrl('/people/front/upol'),
			);
	}

}