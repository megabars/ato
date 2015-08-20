<?php

/**
 * Class OpendataForm
 */
class OpendataForm extends CFormModel
{
    public $fio;
    public $text;
    public $subject;
    public $email;
    public $captcha;

    public function rules()
    {
        return array(
            array('fio, text, email', 'required'),
            array('email', 'email'),
            array('captcha', 'captcha', 'on' => 'insert'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'fio'      => 'Фамилия, имя, отчество',
            'email'    => 'Электронная почта',
            'subject'  => 'Тема сообщения',
            'text'     => 'Сообщение',
            'captcha'  => 'Символы с изображения',
        );
    }
}
