<?php

/**
 * This is the model class for table "rating_project".
 *
 * The followings are the available columns in table 'rating_project':
 * @property integer $id
 * @property string $title
 * @property string $author
 * @property integer $type
 * @property integer $date
 */
class RatingFeedback extends CFormModel
{

    const ALIAS_ORV = 'orv';

    public $fio;
    public $phone;
    public $email;
    public $info;


    public function rules()
    {
        return array(
            array('fio, phone, email', 'required'),
            array('email', 'uniqueEmail','Пользователь с данным email уже подписан на рассылку'),
            array('email', 'email'),
            array('phone','numerical','integerOnly'=>true),
            array('info','safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'fio' => 'ФИО',
            'phone' => 'Контактный телефон',
            'email' => 'Адрес электронной почты',
            'info' => 'Дополнительная информация',
        );
    }

    public function save()
    {
        // создаем подписчика
        $mail = new MailEmailList();

        // если действительно ФИО введено, то разобьем и вставим правильно.
        $fio = explode(' ', $this->fio);
        $count_fio = count($fio);
        if (($count_fio == 3) || ($count_fio == 2))
        {
            $mail->last_name = $fio[0];
            $mail->first_name = $fio[1];
            if ($count_fio == 3)
                $mail->surname = $fio[2];
        }
        else
            $mail->last_name = $this->fio;

        $mail->email = $this->email;
        $mail->agreement = 1;
        if (!$mail->save()) {
            throw new CHttpException(500, 'Ошибка создания подписчика.');
        }

        // Добавляем подписчика в группу рассылки
        $mailGroup = MailGroup::model()->findByAlias(self::ALIAS_ORV);
        $mailList = new MailGroupEmailList();
        $mailList->list_id = $mail->id;
        $mailList->group_id = $mailGroup->id;

        if (!$mailList->save())
            throw new CHttpException(500, 'Ошибка при добавлении подписчика в лист');
        return true;
    }

    public function uniqueEmail($attribute, $params)
    {
        if (MailEmailList::model()->find('email=\''.$this->$attribute.'\''))
            $this->addError($attribute, $params[0]);
    }
}
