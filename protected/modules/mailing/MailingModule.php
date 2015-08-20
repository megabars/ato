<?php

/**
 * Class MailingModule
 * @author Ilshat
 * @version 1.0
 * @name Модуль рассылки писем *
 * @description
 * Модуль отправки писем
 * Настройка модуля в админке - модель SettingsMail
 * Для использования необходимо cron и модуль mail
 *
 * @example
 * Yii::import('application.modules.mail.*');
 * Yii::import('application.modules.mail.helpers.*');
 * Yii::import('application.modules.mail.models.*');
 * Yii::import('application.modules.mailing.*');
 * Yii::import('application.modules.mailing.models.*');
 * $mail = new Mail();
 *
 * $body = $this->renderFile(Yii::getPathOfAlias('application.views.emailTemplate.subscribe') . '.php',array(),true);
 * $mail->send($email, 'Рассылка', $body);
 *
 */
class MailingModule extends CWebModule
{
	public $defaultController = 'mailSubscribe';
	public function init()
	{
		$this->setImport(array(
			'mailing.models.*',
			'mailing.components.*',
		));
	}

}
