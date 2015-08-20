<?php

/**
 * Регистрация эксперта
 * Class OpendataForm
 */
class ExpertsQuestionForm extends CFormModel
{
    public $fio;
    public $phone;
    public $email;
    public $text;
    public $file;
    public $captcha;

    public function rules()
    {
        return array(
            array('fio, phone, email, text', 'required'),
            array('email', 'email'),
            array('captcha', 'captcha', 'on' => 'insert'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'fio' => 'ФИО',
            'phone' => 'Контактный телефон',
            'email' => 'Адрес электронной почты',
            'text' => 'Ваш вопрос',
            'file' => 'Прикрепить файл',
            'captcha' => 'Символы с изображения',
        );
    }
}
