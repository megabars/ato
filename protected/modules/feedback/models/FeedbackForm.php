<?php

/**
 * Class FeedbackForm
 */
class FeedbackForm extends CFormModel
{
    public $fio;
    public $text;
    public $phone;
    public $email;
    public $captcha;
    public $type;

    public function rules()
    {
        return array(
            array('fio, text, email', 'required'),
            array('email', 'email'),
            array('captcha', 'captcha', 'on' => 'insert'),
            array('type', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'fio'      => Yii::t('app', 'Ваше ФИО'),
            'phone'    => Yii::t('app', 'Ваш телефон'),
            'email'    => Yii::t('app', 'Ваш email'),
            'text'     => Yii::t('app', 'Ваш вопрос'),
            'captcha'  => Yii::t('app', 'Код проверки'),
            'type'     => Yii::t('app', 'Тип'),
        );
    }
}
