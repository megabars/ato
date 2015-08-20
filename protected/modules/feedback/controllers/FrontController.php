<?php

class FrontController extends Controller
{
    public function init()
    {
        parent::init();

        //$this->registerModuleAssetsScripts(array(), array('front.css'));
    }

    public function actions()
    {
        return array(
            'captcha' => array(
                'class'     => 'CCaptchaAction',
                'backColor' => 0xe8e8e8,
                'foreColor' => 0x2d8d38,
                'testLimit' => 2,
            ),
        );
    }

    public function actionIndex($type = FeedbackType::QUESTION)
    {
        if (!FeedbackType::instance()->isValid($type))
            $this->errorTo($this->createUrl('/'), 'Неверный тип обратной связи');

        $model = new FeedbackForm();

        $this->performAjaxValidation($model);

        if (isset($_POST['FeedbackForm']))
        {
            $model->attributes = $_POST['FeedbackForm'];

            if ($model->validate())
            {
                $feedback = new Feedback();
                $feedback->attributes = $model->getAttributes();
                $feedback->phone = ' ';
                $feedback->new = 1;
                $feedback->date = time();

                if ($feedback->save())
                {
                    switch ($feedback->type)
                    {
                        case FeedbackType::QUESTION:
                            $message = Yii::t('app', 'Спасибо, ваш вопрос принят, в ближайшее время вам ответит наш специалист');
                            break;
                        case FeedbackType::COMPLAIN:
                            $message = Yii::t('app', 'Спасибо за обращение, ваша жалоба принята, в ближайшее время по вашей проблеме вам ответит наш специалист');
                            break;
                        case FeedbackType::SUGGESTION:
                            $message = Yii::t('app', 'Спасибо, ваш вопрос принят, в ближайшее время вам ответит наш специалист');
                            break;
                        case FeedbackType::SUPPORT:
                            $message = Yii::t('app', 'Спасибо, ваш вопрос принят, в ближайшее время вам ответит наш специалист');
                            break;
                    }

                    $mail = new Mail();
                    $settings = SettingsMail::model()->find();

                    $subject = 'Форма обратной связи';
                    $link = $this->createAbsoluteUrl('/feedback/back/index');
                    $body = "Новое обращение через форму обратной связи на портале ".$this->createAbsoluteUrl('/')." <br\>
                                            Подробная информация по адресу <a href='".$link."' target='_blank'>".$link."</a>";

                    if (!empty($settings->support_addr_1))
                        $mail->send($settings->support_addr_1, $subject, $body);

                    if (!empty($settings->support_addr_2))
                        $mail->send($settings->support_addr_2, $subject, $body);


                    $this->noticeTo('/', $message);
                }
                else {
                    $this->errorTo('/', "Ошибка отправки. Свяжитесь с администратором");
                }
            }
        }

        $model->setScenario('insert');

        $this->renderPartial('index', array(
            'model' => $model,
            'type' => $type,
        ), false, true);
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'feedback-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    public function actionHotlines()
    {
        $model = new Hotlines('search');

        $model->unsetAttributes();

        if (isset($_GET['Hotlines']))
        {
            $model->attributes = $_GET['Hotlines'];
        }

        $this->render('hotlines', array(
            'model' => $model,
        ));
    }
}