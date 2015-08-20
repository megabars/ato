<?php

class FrontController extends Controller
{
    public function init()
    {
        parent::init();

        $this->registerModuleAssetsScripts(array(), array('front.css'));
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->with = 'group';
        $criteria->compare('"group"."alias"', 'main');
        $types = DocumentsFolder::model()->sorted()->published()->findAll($criteria);
        $executives = Executive::model()->npa()->findAll();
        $documents = new Documents('search');

        $documents->unsetAttributes();
        if(isset($_GET['Documents'])) {
            $documents->attributes=$_GET['Documents'];
        }

        $this->render('index', array(
            'types' => $types,
            'executives' => $executives,
            'documents' => $documents->sorted()->published(),
        ));
    }

    public function actionView($id)
    {
        $model = Documents::model()->findByPk($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }


    /* Проекты НПА - ссылка на мокап: http://lnnzfy.axshare.com/#p=проекты_нпа */
    /* todo removed*/
    public function actionProjects()
    {
        $docs = new Documents();
        $docs->unsetAttributes();
        if(isset($_POST['Documents'])) {
            $docs->attributes=$_POST['Documents'];
        }

        $this->render('projects',array(
            'list' => $docs->sorted()->published(),
        ));
    }


    /* Реестры, банки данных - ссылка на мокап: http://lnnzfy.axshare.com/#p=реестры_банки_данных */
    public function actionDatabases()
    {
        $this->render('databases');
    }

    /* Порядок обжалования, ссылка на мокап: http://lnnzfy.axshare.com/#p=порядок_обжалования */
    public function actionAppeal()
    {
        $this->render('appeal');
    }

    /* Административные регламенты Ссылка на мокап: http://lnnzfy.axshare.com/#p=административные_регламенты */
    public function actionRegulations_remove()
    {
        $docs = new Documents();
        $docs->unsetAttributes();
        if(isset($_POST['Documents'])) {
            $docs->attributes=$_POST['Documents'];
        }

        $this->render('regulations',array(
            'documents' => $docs,
            'list' => $docs->sorted(),
        ));
    }

    /* Региональное развитие , ссылка на мокап: http://lnnzfy.axshare.com/#p=стратегическое_планирование_на_региональном_уровне */
    public function actionRegional()
    {
        $this->render('regional');
    }
    /* Региональное развитие , ссылка на мокап: http://lnnzfy.axshare.com/#p=стратегическое_планирование_на_региональном_уровне */
    public function actionStrategy_regional()
    {
        $this->render('strategy_regional');
    }


    /*Доклады о результатах и основных направлениях деятельности подразделений Администрации Томской области*/
    public function actionReports()
    {
        $this->render('reports');
    }

    /*Оценка эффективности деятельности органов государственной власти субъекта РФ*/
    /* todo removed*/
    public function actionRatings()
    {
        $this->render('ratings');
    }

}