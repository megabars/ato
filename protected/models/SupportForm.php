<?php

/**
 * Техподдержка в админке
 * Class SupportForm
 */
class SupportForm extends CFormModel
{
    public $name;
    public $email;
    public $phone;
    public $text;
    public $attachment;

    public function rules()
    {
        return array(
            array('email, text', 'required'),
            array('email', 'email'),
            array('name, phone, attachment', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Ваше имя',
            'email' => 'Адрес электронной почты',
            'phone' => 'Контактный телефон',
            'text' => 'Ваш вопрос',
            'attachment' => 'Скриншот ошибки'
        );
    }
}
