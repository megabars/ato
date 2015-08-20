<?php

/**
 * Class FeedbackType
 */
class FeedbackType extends Reference
{
    const QUESTION     = 1;
    const COMPLAIN     = 2;
    const SUGGESTION   = 3;
    const SUPPORT      = 4;

    function __construct()
    {
        $this->list = array(
            self::QUESTION    => Yii::t('app', 'Задать вопрос'),
            self::COMPLAIN    => Yii::t('app', 'Пожаловаться'),
            self::SUGGESTION  => Yii::t('app', 'Отзывы и предложения'),
            self::SUPPORT     => Yii::t('app', 'Техническая поддержка'),
        );
    }
}