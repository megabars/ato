<?php

/**
 * Class SubscribeCommand
 * @author Ilshat
 * @version 1.0
 * @name Рассылка писем
 * @description
 * Модуль отправки писем
 * Настройка модуля в админке - модель SettingsMail
 * Для использования необходимо cron и модуль mail
 *
 * cron
 * 0 * * * * ./yiic subscribe
 */

class SubscribeCommand extends CConsoleCommand
{
	public $mail = null;

	public function actionIndex()
	{
		Yii::import('application.modules.files.*');
		Yii::import('application.modules.files.helpers.*');
		Yii::import('application.modules.files.models.*');

		Yii::import('application.modules.mail.*');
		Yii::import('application.modules.mail.helpers.*');
		Yii::import('application.modules.mail.models.*');

		Yii::import('application.modules.mailing.*');
		Yii::import('application.modules.mailing.models.*');

        $this->sendSubscribe();
        $this->sendNotice();
        $this->sendNewsSubscribe();
	}

    public function sendSubscribe()
    {
        $subscribe = MailSubscribe::model()->findAll('date<=' . time()." AND is_send=0");

        if (!empty($subscribe))
            foreach ($subscribe as $s)
            {
                $mail = new Mail();

                if(!empty($s->sender_email))
                {
                    $mail->mail->setFrom($s->sender_email, Yii::app()->name);
                    echo "From ".$mail->mail->From."\n";
                }

                if(!empty($s->files))
                    foreach($s->files as $f)
                        if($f->file)
                            $mail->mail->addAttachment($f->file->getFilePath($f->file->id),$f->file->origin_name);

                if(isset($s->group->emails))
                {
                    $content = @$s->template->content;

                    foreach ($s->group->emails as $email)
                    {
                        $body = $this->renderFile(
                            Yii::getPathOfAlias('application.themes.emailTemplate.subscribe') . '.php',
                            array('model' => @$email->list,'content' => $content),true);

                        if($mail->send(@$email->list->email, 'Рассылка', $body))
                            echo "Send Mail\n";
                    }
                }
                $s->is_send=1;
                $s->save();
            }
    }

    public function sendNotice()
    {
        /**
         * Уведомлением о включении адреса в список рассылки.
         */
        if($email_list = MailEmailList::model()->findAll('is_alert=0')) {
            foreach ($email_list as $el)
            {
                $mail = new Mail();
                $body = $this->renderFile(
                    Yii::getPathOfAlias('application.themes.emailTemplate.alert') . '.php',
                    array('model' => @$el),true);

                if($mail->send(@$el->email, 'Вы подписаны на уведомления от госпортала', $body))
                {
                    $el->is_alert=1;
                    $el->save();
                    echo "Send Alert\n";
                }
            }
        }
    }

    public function sendNewsSubscribe()
    {
        /**
         * Рассылка новостей
         */
        if(date('G')==8) // в восемь утра
        {
            Yii::app()->request->setBaseUrl('tomsk_portal'); // Для получения правильных урлов хост нужно задать жестко

            $mail = new Mail();

            $subscribers = NewsSubscribers::model()->findAll();

            $news = News::model()->sorted()->published()->findAllByAttributes(
                array(),
                $condition = 'date >= :start AND date <= :end', // за последние сутки
                $params = array(
                    ':start' => time() - (86400),
                    ':end' => mktime (8, 0, 0, date("n"), date("j"), date("Y")),
                ));

            if (!empty($subscribers) && !empty($news)) {
                foreach ($subscribers as $subscriber) {
                    $body = $this->renderFile(Yii::getPathOfAlias('application.themes.emailTemplate.news_subscribe') . '.php', array(
                        'model' => $subscriber,
                        'news' => $news,
                    ), true);

                    if ($mail->send($subscriber->email, 'Рассылка новостей', $body))
                        echo "Send Mail\n";
                }
            }
        }
    }
}

