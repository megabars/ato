<?php

class SubscribeForm extends CFormModel
{
    public $subscriber;
    public $email;

    public function rules()
    {
        return array(
            array('subscriber, email', 'required','message'=>Yii::t('app', 'Это поле является обязательным для заполнения.')),
            array('email', 'email','message'=>Yii::t('app', 'Введите корректный e-mail')),
            array('subscriber, email', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'subscriber' => Yii::t('app', 'Ваше имя'),
            'email' => Yii::t('app', 'Ваш email'),
        );
    }
}
