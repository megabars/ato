<?php

class Mail extends CComponent
{
    /**
     * @var $mail PHPMailer
     */
    public $mail = null;

    public function __construct()
    {
        $this->mail = Yii::app()->mailer;
        $this->mail->setLanguage('ru');
        $settings = SettingsMail::model()->find();

        if($settings->type == SettingsMail::TYPE_SMTP)
        {
            $this->mail->isSMTP();
            $this->mail->SMTPAuth = true;
            $this->mail->Host = $settings->smtp_host;
            $this->mail->Username = $settings->smtp_username;
            $this->mail->Password = $settings->smtp_password;

            if ($settings->smtp_host == 'smtp.gmail.com')
                $this->mail->SMTPSecure = 'tls';

            $this->mail->Port = $settings->smtp_port;
        }
        else
        {
            $this->mail->IsSendmail();
            if(!empty($settings->sendmail_path))
                $this->mail->Sendmail = $settings->sendmail_path;
        }

        $this->mail->SetFrom($settings->server_email, Yii::app()->name);
        $this->mail->AddReplyTo($settings->server_email,Yii::app()->name);
        $this->mail->isHTML(true);

    }

    public function send($email, $subject, $body)
    {
		$this->mail->addAddress($email);
		$this->mail->Subject = $subject;
		$this->mail->Body    = $body;
		$send = $this->mail->send();
		$this->mail->clearAddresses();
		$this->mail->clearAttachments();

        if (!$send) {
            Yii::log("Cant send email message! mail is:".print_r($this->mail, true), CLogger::LEVEL_ERROR);
//            print_r($this->mail);
            throw new CHttpException(500, "Не удалось отправить сообщение");

        }

		return $send;
    }
}
