<?php

/**
 * Class FrontController
 */

class FrontController extends Controller
{
    public function actionIndex()
    {
        $frame = '';
        $this->render('index', array(
            'frame' => $frame
        ));
    }

    public function actionDocument()
    {
        $model = new AcDocument('search');
        $model->unsetAttributes();

        if (isset($_GET['AcDocument'])) {
            $model->attributes = $_GET['AcDocument'];
        }

        $this->render('document', array(
            'model' => $model
        ));
    }

    public function actionExpertise($id = null)
    {
        if ($id == null) {
            $model = new AcExpertise('search');
            $model->unsetAttributes();

            if (isset($_GET['AcExpertise'])) {
                $model->attributes = $_GET['AcExpertise'];
            }

            if ($this->portalId == 1)
                $model->disablePortalCriteria = true;


            $this->render('expertise/index', array(
                'model' => $model
            ));
        } else {
            $model = AcExpertise::model()->findByPk($id);

            $this->render('expertise/view', array(
                'model' => $model
            ));
        }

    }

    public function actionMethodical()
    {
        $this->pageTitle = 'Методические материалы';

        $model = new AcFile('search');
        $model->unsetAttributes();

        $model->type = DocumentType::METHODICAL;

        if (isset($_GET['AcFile'])) {
            $model->attributes = $_GET['AcFile'];
        }

        $this->render('file', array(
            'model' => $model
        ));
    }

    public function actionCertificate()
    {
        $this->pageTitle = 'Формы справок о доходах и расходах';

        $model = new AcFile('search');
        $model->unsetAttributes();

        $model->type = DocumentType::CERTIFICATE;

        if (isset($_GET['AcFile'])) {
            $model->attributes = $_GET['AcFile'];
        }

        $this->render('file', array(
            'model' => $model
        ));
    }

    public function actionPublic($type = 1)
    {
        // Года
        $c1 = new CDbCriteria();
        $c1->distinct = true;
        $c1->select = 'year';
        $c1->order = 'year ASC';
        $years = CHtml::listData(AcPublic::model()->findAll($c1), 'year', 'year');

        // Записи
        $c2 = new CDbCriteria();
        if (!empty($years)) {
            $year = current($years);

            if (isset($_GET['year']))
                $year = $_GET['year'];

            $c2->condition = 'year = :year AND type = :type';
            $c2->params = array(
                ':year' => $year,
                ':type' => $type
            );
        }

        $model = AcPublic::model()->findAll($c2);

        $categories = CategoryPost::model()->findAll();

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('public/_list', array(
                'categories' => $categories,
                'model' => $model,
            ));
        } else {
            if ($type == 1) {
                $this->pageTitle = 'Сведения о доходах, об имуществе и обязательствах имущественного характера';
            } elseif ($type == 2) {
                $this->pageTitle = 'Сведения о расходах на совершение сделок по приобретению недвижимого имущества, транспортного средства, ценных бумаг, акций';
            } else {
                $this->redirect('/antiCorruption/front/public');
            }

            $this->render('public/index', array(
                'years' => $years,
                'categories' => $categories,
                'model' => $model,
                'type' => $type,
            ));
        }
    }

    public function actionCommission()
    {
        $model = new AcMembers();
        $model->unsetAttributes();

        $commission = AcCommission::model()->findByPk(1);

        $this->render('commission/index', array(
            'model' => $model,
            'commission' => $commission
        ));
    }

    public function actionRegulation()
    {
        $this->pageTitle = 'Положение';

        $model = new AcFile('search');
        $model->unsetAttributes();

        $model->type = DocumentType::SITUATION;

        if (isset($_GET['AcFile'])) {
            $model->attributes = $_GET['AcFile'];
        }

        $this->render('commission/file', array(
            'model' => $model
        ));
    }

    public function actionSchedule()
    {
        $model = new AcSchedule('search');
        $model->unsetAttributes();

        if (isset($_GET['AcSchedule'])) {
            $model->attributes = $_GET['AcSchedule'];
        }

        $this->render('commission/schedule', array(
            'model' => $model,
        ));
    }

    public function actionMeeting()
    {
        $this->pageTitle = 'Материалы заседаний';

        $model = new AcFile('search');
        $model->unsetAttributes();

        $model->type = DocumentType::MEETING;

        if (isset($_GET['AcFile'])) {
            $model->attributes = $_GET['AcFile'];
        }

        $this->render('commission/file', array(
            'model' => $model
        ));
    }

    public function actionInfo()
    {
        $this->pageTitle = 'Информационные материалы';

        $model = new AcFile('search');
        $model->unsetAttributes();

        $model->type = DocumentType::INFO;

        if (isset($_GET['AcFile'])) {
            $model->attributes = $_GET['AcFile'];
        }

        $this->render('commission/file', array(
            'model' => $model
        ));
    }

    public function actionAppeal()
    {
        $this->pageTitle = 'Материалы заседаний';

        $model = new AcFile('search');
        $model->unsetAttributes();

        $model->type = DocumentType::APPEAL;

        if (isset($_GET['AcFile'])) {
            $model->attributes = $_GET['AcFile'];
        }

        $this->render('commission/file', array(
            'model' => $model
        ));
    }
}