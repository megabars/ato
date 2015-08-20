<?php

/**
 * Регистрация эксперта
 * Class ExpertsStep3Form
 */
class ExpertsStep3Form extends CFormModel
{
    public $fio; //r
    public $emails = array(); //r
    public $phones = array(); //r
    public $sites = array();
    public $socials = array();
    public $blogs = array();
    public $birthday; //r
    public $citizenship; //r
    public $address_id;
    public $address;
    public $restriction = 0; //r
    public $photo;

    public $region_list;
    public $resources_list;

    public function __construct()
    {
        $this->region_list = CHtml::listData(Maps::model()->findAll(array('order'=>'name ASC')),'id','name');
        $this->resources_list = array(
            'sites'=>'Сайт',
            'socials'=>'Социальная сеть',
            'blogs'=>'Блог',
        );
        parent::__construct();
    }

    public function rules()
    {
        return array(
            array('emails', 'validateEmails'),
            array('phones', 'validatePhones'),
            array('sites, socials, blogs', 'validateUrls'),
            array('fio, birthday, phones, citizenship, restriction', 'required'),
            array('restriction, photo', 'numerical', 'integerOnly'=>true),
            array('fio, emails, phones, sites, socials, blogs, birthday, citizenship, restriction, address, photo','safe')
        );
    }

    public function validateEmails($attribute) {
        if (is_array($this->$attribute)) {
            foreach ($this->$attribute as $key=>$value) {
                $validator = new CEmailValidator;
                if(!$validator->validateValue($value))
                    $this->addError("{$attribute}[{$key}]", 'Адрес электронной почты не корректный');
            }
        }
    }

    public function validatePhones($attribute) {
        if (is_array($this->$attribute)) {
            $count = 0;
            foreach ($this->$attribute as $key=>$value) {
                if(!empty($value))
                    $count++;
            }
            if($count == 0)
                $this->addError("{$attribute}[1]", 'Необходимо указать хотя бы 1 номер');
        }
    }

    public function validateUrls($attribute) {
        if (is_array($this->$attribute)) {
            foreach ($this->$attribute as $key=>$value) {
                if(!empty($value)) {
                    $validator = new CUrlValidator;
                    $validator->defaultScheme = 'http';
                    $validator->validateIDN = true;
                    if(!$validator->validateValue($value))
                        $this->addError("{$attribute}[{$key}]", 'Адрес некорректен');
                }
            }
        }
    }

    public function attributeLabels()
    {
        return array(
            'fio' => 'ФИО',
            'emails' => 'Адрес электронной почты',
            'phones' => 'Контактный телефон',
            'sites' => 'Сайт',
            'socials' => 'Социальная сеть',
            'blogs' => 'Блог',
            'birthday' => 'Дата рождения',
            'citizenship' => 'Гражданство',
            'address' => 'Место проживания',
            'restriction' => 'Имелись ли решения суда, связанные с ограничениями Ваших прав?',
            'photo' => 'Фотография',
        );
    }
}
