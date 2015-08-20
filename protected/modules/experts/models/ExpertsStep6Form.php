<?php

/**
 * Регистрация эксперта
 * Class ExpertsStep6Form
 */
class ExpertsStep6Form extends CFormModel
{
    public $prospect;
    public $expert_work;
    public $public_organization;
    public $wish;
    public $project;
    public $qualification;
    public $additional_information;

    public $captcha;

    public function rules()
    {
        return array(
            array('captcha', 'captcha'),
            array('prospect, expert_work, public_organization, wish, project, qualification, additional_information, captcha','safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'prospect' => 'Какими Вы видите ваши профессиональные перспективы?',
            'expert_work' => 'Опыт участия в экспертной работе (участие в качестве, члена рабочей группы, разработчика нормативных актов)',
            'public_organization' => 'Опыт участия в деятельности общественных организаций',
            'wish' => 'Чего бы Вы хотели добиться, участвуя в работе Экспертного совета при заместителе Губернатора Томской области?',
            'project' => 'Напишите значимые проекты с Вашим участием, с помощью которых удалось решить общественную проблему',
            'qualification' => 'Хотите ли Вы сообщить дополнительные сведения о Вашей квалификации, которые могут повлиять на окончательное решение при отборе в Экспертный совет при заместителе Губернатора Томской области?',
            'additional_information' => 'Дополнительная информация',
            'captcha' => 'Код проверки',
        );
    }
}
