<?php
/**
 * Контроллер экспертных советов
 */

class FrontController extends Controller {

    public function init()
    {
        parent::init();

        $this->registerModuleAssetsScripts(array(), array('front.css'));
    }

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xe8e8e8,
                'foreColor' => 0x8c9295,
                'testLimit'=>0, //Отключаем возможность изменения пароля при валидации - для ajax валидации
            ),
        );
    }

    /**
     * Протоколы заседаний и заключения, доступен только на субпортале экспертных советов
     */
    public function actionProtocols(){
        $model = new ExpertProtocols('search');

        $model->unsetAttributes();

        if(isset($_GET['ExpertProtocols'])) {
            $model->attributes=$_GET['ExpertProtocols'];
        }

        $this->render('protocols',array(
            'model'=>$model
        ));


    }


    public function actionIndex()
    {
        $model = new Experts('search');

        $model->unsetAttributes();

        if(isset($_GET['Experts'])) {
            $model->attributes=$_GET['Experts'];
        }

        $this->render('index',array(
            'model'=>$model->accepted()->sorted()
        ));
    }

    public function actionView($id)
    {
        $model = Experts::model()->findByPk($id);
        $this->render('database_view',array('model'=>$model));
    }

    public function actionRegister()
    {
        $step1_model = new ExpertsStep1Form();
        $step2_model = new ExpertsStep2Form();
        $step3_model = new ExpertsStep3Form();
        $step4_model = new ExpertsStep4Form();
        $step5_model = new ExpertsStep5Form();
        $step6_model = new ExpertsStep6Form();

        $modelSettings = $this->loadSettingsModel();

        if (!empty($modelSettings) && !$modelSettings->isActive) {
            $this->redirect('/');
        }

        if(isset($_POST['ExpertsStep1Form'])) {
            $step1_model->setAttributes($_POST['ExpertsStep1Form'],true);
            $this->performAjaxValidation($step1_model, 1);
        }

        if(isset($_POST['ExpertsStep2Form'])) {
            $step1_model->setAttributes($_POST['ExpertsStep2Form'],true);
            $this->performAjaxValidation($step2_model, 2);
        }

        if(isset($_POST['ExpertsStep3Form'])) {
            $step1_model->setAttributes($_POST['ExpertsStep3Form'],true);
            $this->performAjaxValidation($step3_model, 3);
        }

        if(isset($_POST['ExpertsStep4Form'])) {
            $step1_model->setAttributes($_POST['ExpertsStep4Form'],true);
            $this->performAjaxValidation($step4_model, 4);
        }

        if(isset($_POST['ExpertsStep5Form'])) {
            $step1_model->setAttributes($_POST['ExpertsStep5Form'],true);
            $this->performAjaxValidation($step5_model, 5);
        }

        if(isset($_POST['ExpertsStep6Form'])) {
            $step1_model->setAttributes($_POST['ExpertsStep6Form'],true);
            $this->performAjaxValidation($step6_model, 6);
        }

        $this->render('register', array(
            'step1_model' => $step1_model,
            'modelSettings' => $modelSettings,
            'step2_model' => $step2_model,
            'step3_model' => $step3_model,
            'step4_model' => $step4_model,
            'step5_model' => $step5_model,
            'step6_model' => $step6_model,
        ));
    }

    public function actionSaveExpert()
    {
        $transaction = Yii::app()->db->beginTransaction();

        $expert = new Experts();

        if(isset($_POST['ExpertsStep1Form'])) {
            $expert->expert_council_id = $_POST['ExpertsStep1Form']['portal_id'];
        }
        if(isset($_POST['ExpertsStep2Form']) && $_POST['ExpertsStep2Form']['agree'] != 1) {
            echo json_encode((object)array('status' => 'error', 'message' => 'Вы не дали согласие на обработку данных"'));
            Yii::app()->end();
        }
        if(isset($_POST['ExpertsStep3Form'])) {
            $expert->setAttributes($_POST['ExpertsStep3Form'], false);
            $expert->address = $_POST['ExpertsStep3Form']['address_type']==0 ? @Maps::model()->findByPk($_POST['ExpertsStep3Form']['address_id'])->name : $_POST['ExpertsStep3Form']['address'];
        }
        if(isset($_POST['ExpertsStep4Form'])) {
            $expert->setAttributes($_POST['ExpertsStep4Form'], false);
        }
        if(isset($_POST['ExpertsStep5Form'])) {
            $expert->setAttributes($_POST['ExpertsStep5Form'], false);

            if(is_array($expert->professional_interests)) {
                $professional_interests = array();
                foreach($expert->professional_interests as $interest) {
                    if(is_array($interest)) {
                        foreach($interest as $text) {
                            if(trim($text) != '')
                                $professional_interests[] = $text;
                        }

                    } else
                        $professional_interests[] = $interest;
                }

                $expert->professional_interests = implode(', ', $professional_interests);
            }
        }
        if(isset($_POST['ExpertsStep6Form'])) {
            $expert->setAttributes($_POST['ExpertsStep6Form'], false);
        }

        $expert->state = $expert::STATUS_UNWATCHED;

        try {
            if($expert->save()) {

                $expert_id = $expert->id;

                //resources
                $emails = $_POST['ExpertsStep3Form']['emails'];
                foreach($emails as $email) {
                    if(trim($email) != '') {
                        $expert_resource = new ExpertResources();
                        $expert_resource->expert_id = $expert_id;
                        $expert_resource->type = ContactType::EMAIL;
                        $expert_resource->value = $email;
                        if(!$expert_resource->save())
                            throw new Exception(print_r($expert_resource->getErrors(), true));
                    }
                }
                $phones = $_POST['ExpertsStep3Form']['phones'];
                foreach($phones as $phone) {
                    if(trim($phone) != '') {
                        $expert_resource = new ExpertResources();
                        $expert_resource->expert_id = $expert_id;
                        $expert_resource->type = ContactType::PHONE;
                        $expert_resource->value = $phone;
                        if(!$expert_resource->save())
                            throw new Exception(print_r($expert_resource->getErrors(), true));
                    }
                }
                $sites = $_POST['ExpertsStep3Form']['sites'];
                foreach($sites as $site) {
                    if(trim($site) != '') {
                        $expert_resource = new ExpertResources();
                        $expert_resource->expert_id = $expert_id;
                        $expert_resource->type = ContactType::WEB;
                        $expert_resource->value = $site;
                        if(!$expert_resource->save())
                            throw new Exception(print_r($expert_resource->getErrors(), true));
                    }
                }
                $socials = $_POST['ExpertsStep3Form']['socials'];
                foreach($socials as $social) {
                    if(trim($social) != '') {
                        $expert_resource = new ExpertResources();
                        $expert_resource->expert_id = $expert_id;
                        $expert_resource->type = ContactType::SOCIAL;
                        $expert_resource->value = $social;
                        if(!$expert_resource->save())
                            throw new Exception(print_r($expert_resource->getErrors(), true));
                    }
                }
                $blogs = $_POST['ExpertsStep3Form']['blogs'];
                foreach($blogs as $blog) {
                    if(trim($blog) != '') {
                        $expert_resource = new ExpertResources();
                        $expert_resource->expert_id = $expert_id;
                        $expert_resource->type = ContactType::BLOG;
                        $expert_resource->value = $blog;
                        if(!$expert_resource->save())
                            throw new Exception(print_r($expert_resource->getErrors(), true));
                    }
                }

                //educations
                $educations = Experts::arraySortingToLine($_POST['ExpertsStep4Form']['education'], false);
                foreach($educations as $education) {
                    $expert_education = new ExpertEducations();
                    $expert_education->expert_id = $expert_id;
                    $expert_education->year = $education['year'];
                    $expert_education->specialty = $education['specialty'];
                    $expert_education->institution = $education['institution'];
                    if(!$expert_education->save())
                        throw new Exception(print_r($expert_education->getErrors(), true));
                }
                $further_educations = Experts::arraySortingToLine($_POST['ExpertsStep4Form']['further_education'], false);
                foreach($further_educations as $education) {
                    $expert_education = new ExpertEducations();
                    $expert_education->expert_id = $expert_id;
                    $expert_education->year = $education['year'];
                    $expert_education->additional = $education['name'];
                    if(!$expert_education->save())
                        throw new Exception(print_r($expert_education->getErrors(), true));
                }

                //regalia
                if($expert->degree == 1) {
                    $degrees = Experts::arraySortingToLine($_POST['ExpertsStep4Form']['degrees'], false);
                    foreach($degrees as $degree) {
                        $expert_regalia = new ExpertRegalia();
                        $expert_regalia->expert_id = $expert_id;
                        $expert_regalia->type = RegaliaType::DEGREE;
                        $expert_regalia->year = $degree['year'];
                        $expert_regalia->name = $degree['name'];
                        $expert_regalia->document = $degree['document'];
                        if(!$expert_regalia->save())
                            throw new Exception(print_r($expert_regalia->getErrors(), true));
                    }
                }
                if($expert->academic == 1) {
                    $academics = Experts::arraySortingToLine($_POST['ExpertsStep4Form']['academics'], false);
                    foreach($academics as $academic) {
                        $expert_regalia = new ExpertRegalia();
                        $expert_regalia->expert_id = $expert_id;
                        $expert_regalia->type = RegaliaType::ACADEMIC;
                        $expert_regalia->year = $academic['year'];
                        $expert_regalia->name = $academic['name'];
                        $expert_regalia->document = $academic['document'];
                        if(!$expert_regalia->save())
                            throw new Exception(print_r($expert_regalia->getErrors(), true));
                    }
                }
                if($expert->honorary == 1) {
                    $honoraries = Experts::arraySortingToLine($_POST['ExpertsStep4Form']['honoraries'], false);
                    foreach($honoraries as $honorary) {
                        $expert_regalia = new ExpertRegalia();
                        $expert_regalia->expert_id = $expert_id;
                        $expert_regalia->type = RegaliaType::HONORARY;
                        $expert_regalia->year = $honorary['year'];
                        $expert_regalia->name = $honorary['name'];
                        $expert_regalia->document = $honorary['document'];
                        if(!$expert_regalia->save())
                            throw new Exception(print_r($expert_regalia->getErrors(), true));
                    }
                }

                // experience
                $experiences = Experts::arraySortingToLine($_POST['ExpertsStep5Form']['experience'], false);
                foreach($experiences as $experience) {
                    $expert_experience = new ExpertExperience();
                    $expert_experience->expert_id = $expert_id;
                    $expert_experience->period = $experience['period'];
                    $expert_experience->organization = $experience['organization'];
                    $expert_experience->post = $experience['post'];
                    if(!$expert_experience->save())
                        throw new Exception(print_r($expert_experience->getErrors(), true));
                }

                $transaction->commit();
                Yii::app()->user->setFlash('notice', "Вы успешно зарегистрировались");
                echo json_encode((object)array('status' => 'success'));
                Yii::app()->end();
            } else {
                throw new Exception(print_r($expert->getErrors(), true));
            }



        } catch (Exception $e) {
            $transaction->rollBack();

            $error = ($e->getMessage() != '') ? $e->getMessage() : 'Пожалуйста, обратитесь к администратору';
            echo json_encode((object)array('status' => 'error', 'message' => 'Произошла ошибка: <br>'.$error));
            Yii::app()->end();
        }
    }

    protected function performAjaxValidation($model, $step)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'expert-register-step'.$step.'-form') {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    /* Список участников экспертного совета */
    public function actionMember()
    {
        $this->render('member');
    }

    public function actionMemberId()
    {
        $this->render('member_view');
    }


    /* Задать вопрос */
    public function actionQuestion()
    {
        $model = new ExpertsQuestionForm();

        $this->render('question', array(
            'model' => $model
        ));
    }

//    public function actionProtocols()
//    {
//        $this->render('protocols');
//    }

    public function actionArchive()
    {
        $this->render('archive');
    }

    public function loadSettingsModel()
    {
        $model = ExpertSettings::model()->findAll(array('limit'=>1));

        if ($model === NULL)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return isset($model[0]) ? $model[0] : $model;
    }

}