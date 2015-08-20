<?php

class MainController extends AdminController
{
	public function actionIndex()
	{

        $script = Yii::app()->getClientScript();
        $script->registerScriptFile($this->getAssetsBase() . '/js/Chart.min.js');

        $log = Log::model()->sorted()->limit(4)->findAll();

        /*
         * выводим инфу по серверу
         */
        $system = array(
            'max_hdd'=>disk_total_space("/"),
            'free_hdd'=>disk_free_space("/"),
            'max_memory'=>SI::getTotalMem(),
            'free_memory'=>SI::getFreeMem(),
            'cms'=>@Yii::app()->params['CMS_version'],
            'php'=>Utils::replaseOs(SI::getPhpVersion()),
            'mysql'=>Utils::replaseOs(Yii::app()->db->getServerVersion()),
            'uptime'=>SI::getUptime()
        );

        /*
         * выводим количество фидбеков
         */
        $feedbackModel = new Feedback();

        $feedback = array(
            'question' => count($feedbackModel->findAllByAttributes(array('type'=>FeedbackType::QUESTION))),
            'new_question' => count($feedbackModel->findAllByAttributes(array('type'=>FeedbackType::QUESTION, 'new' => 1))),
            'complain' => count($feedbackModel->findAllByAttributes(array('type'=>FeedbackType::COMPLAIN))),
            'new_complain' => count($feedbackModel->findAllByAttributes(array('type'=>FeedbackType::COMPLAIN, 'new' => 1))),
            'suggestion' => count($feedbackModel->findAllByAttributes(array('type'=>FeedbackType::SUGGESTION))),
            'new_suggestion' => count($feedbackModel->findAllByAttributes(array('type'=>FeedbackType::SUGGESTION, 'new' => 1))),
            'support' => count($feedbackModel->findAllByAttributes(array('type'=>FeedbackType::SUPPORT))),
            'new_support' => count($feedbackModel->findAllByAttributes(array('type'=>FeedbackType::SUPPORT, 'new' => 1))),
        );

        $this->render('index', array(
            'log' => $log,
            'system' => $system,
            'feedback' => $feedback,
        ));
	}

    public function actionService()
    {
        $this->render('service');
    }

    public function actionJournal()
    {
        $model = new Log('search');

        $model->unsetAttributes();

        if (isset($_GET['Log'])) {
            $model->attributes = $_GET['Log'];
        }

        $this->render('journal', array(
            'model' => $model,
        ));
    }

    // Техподдрежка. Обратная связь
    public function actionFeedback(){
        $model = new SupportForm();
        $settings = SettingsMail::model()->find();

        $this->performAjaxValidation($model, 'feedback-form');


        if (isset($_POST['SupportForm'])) {

            $model->attributes = $_POST['SupportForm'];

            if ($model->validate()) {
                $subject = 'Техподдержка';
                $body = '<h3>'.$_POST['SupportForm']['name'].'</h3><div>'.$_POST['SupportForm']['phone'].'</div><div>'.$_POST['SupportForm']['text'].'</div>';
                $mail = new Mail();

                if (is_numeric($model->attachment)) {
                    $file = File::model()->findByPk($model->attachment);
                    $mail->mail->addAttachment($file->getFilePath());
                }

                if (!empty($settings->support_addr_1))
                    $mail->send($settings->support_addr_1, $subject, $body);

                if (!empty($settings->support_addr_2))
                    $mail->send($settings->support_addr_2, $subject, $body);


                $this->redirect('/admin');
            }
        }

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('feedback', array(
                'model' => $model
            ), false, true);
        } else {
            $this->redirect('/admin');
        }
    }



    protected function performAjaxValidation($model, $formName)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === $formName) {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    // Yandex
    public function actionMetrika($beginDay = null, $endDay = null)
    {
        $begin_day = date('Ymd', strtotime('-7 day'));
        $end_day = date("Ymd");

        if($beginDay != null) {
            $begin_day = date('Ymd', $beginDay);
        }

        if($endDay != null) {
            $end_day = date('Ymd', $endDay);
        }

        $metrika_id = '28522211';
        $mail = 'tomsk.gov@yandex.ru';
        $pass = 'magarramovada';
        $app_id = 'b52a6d02f6cb475aa1078bfc06eaed0d';
        $app_token = '760f847aa183444d888092616c14afa0';
        $yandex_get_token_url = "http://oauth.yandex.ru/token";


        // Получаем токен
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $yandex_get_token_url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=password&username='.$mail.'&password='.$pass.'&client_id='.$app_id.'&client_secret='.$app_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $token = curl_exec($ch);
        curl_close($ch);

        list($headers, $content) = explode("\r\n\r\n",$token,2);
        $json = json_decode($content);


        // Получаем данные из метрики
        $metrika_url = "http://api-metrika.yandex.ru/stat/traffic/summary.json?id=".$metrika_id."&pretty=1&date1=$begin_day&date2=$end_day&oauth_token=".$json->access_token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $metrika_url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $metrika = curl_exec($ch);
        curl_close ($ch);

        $arr_data = json_decode($metrika);

        function cmp($a, $b) {
            if ($a->date == $b->date) {
                return 0;
            }
            return ($a->date < $b->date) ? -1 : 1;
        }

        uasort($arr_data->data, 'cmp');

        // Перестраиваем данные для хайчартса
        $datetime = null;
        $data_visits = null;
        $data_page_views = null;
        $data_visitors = null;

        foreach($arr_data->data as $item) {
            $data_visits[] = $item->visits;
            $data_page_views[] = $item->page_views;
            $data_visitors[] = $item->visitors;
            $datetime[] = Rudate::date(date('j M',strtotime($item->date)));
        }


        $diff=(strtotime($end_day)-strtotime($begin_day))/3600/24;
        if($diff > 31) {
            $datetime = array(
                "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
            );
        }

        $mainData = array(
            'labels' => $datetime,
            'datasets' => array(
                array(
                    'label' => 'Просмотры',
                    'fillColor' => "rgba(255,255,255,0)",
                    'strokeColor' => "#fe7b1e",
                    'pointColor' => "#fe7b1e",
                    'pointStrokeColor' => "#fff",
                    'pointHighlightFill' => "#fff",
                    'pointHighlightStroke' => "#fe7b1e",
                    'data' => $data_page_views,
                ),
                array(
                    'label' => 'Визиты',
                    'fillColor' => "rgba(255,255,255,0)",
                    'strokeColor' => "#fcce00",
                    'pointColor' => "#fcce00",
                    'pointStrokeColor' => "#fff",
                    'pointHighlightFill' => "#fff",
                    'pointHighlightStroke' => "#fcce00",
                    'data' => $data_visits,
                ),
                array(
                    'label' => 'Посетители',
                    'fillColor' => "rgba(255,255,255,0)",
                    'strokeColor' => "#b39bf9",
                    'pointColor' => "#b39bf9",
                    'pointStrokeColor' => "#fff",
                    'pointHighlightFill' => "#fff",
                    'pointHighlightStroke' => "#b39bf9",
                    'data' => $data_visitors,
                ),
            )
        );

        header('Content-type: application/json');
        echo json_encode($mainData);
    }


    public function actionStaticPageAccess()
    {
        $model = new Portal('search');

        $model->unsetAttributes();

        if (isset($_GET['Portal']))
            $model->attributes = $_GET['Portal'];

        $this->render('static_page_access', array(
            'model' => $model,
        ));
    }

    public function actionStaticPageAccessUpdate($id)
    {
        if (!$model = StaticPageAccess::model()->findByAttributes(array('usr_portal_id' => $id)))
            $model = new StaticPageAccess();

        if (isset($_POST['StaticPageAccess']))
        {
            $model->rule = implode(',', $_POST['StaticPageAccess']['rule']);
            $model->usr_portal_id = $id;

            if ($model->save())
                $this->noticeTo($this->createUrl('/admin/main/staticPageAccess'), 'Данные успешно сохранены');
        }

        $items = array();
        foreach (NavItems::model()->findAllByAttributes(array('menuId' => 28, 'is_deleted' => 0)) as $item)
        {
            if ($item->parent_id && $parent = NavItems::model()->findByPk($item->parent_id))
            {
                $items[$item->id] = $parent->title . ' - ' . $item->title;
            }
            else
                $items[$item->id] = $item->title;
        }

        $selected = array();
        foreach (explode(',', $model->rule) as $item)
            $selected[$item] = array('selected' => TRUE);

        $this->render('static_page_access_update', array(
            'portal' => Portal::model()->findByPk($id),
            'model' => $model,
            'items' => $items,
            'selected' => $selected,
        ));
    }
}