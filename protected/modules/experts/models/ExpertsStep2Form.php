<?php

/**
 * Регистрация эксперта
 * Class ExpertsStep2Form
 */
class ExpertsStep2Form extends CFormModel
{
    public $agree; //r

    public function rules()
    {
        return array(
            array('agree', 'compare', 'compareValue'=>1, 'message'=>'Чтобы зарегистрироваться, необходимо принять условия'),
            array('agree', 'numerical', 'integerOnly'=>true),
            array('agree','safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'agree' => 'Я согласен с условиями',
        );
    }
}
