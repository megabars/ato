<?php

/**
 * Enum - Класс для работы всех сущностей типа "Pages"
 * Class RecordType
 */
class RecordType extends Reference
{
    const DEF = 0;
    const EVENT = 1;
    const THEMES = 2;
    const VERB_REPORT = 3;
    const ADM = 4;
    const REGION = 5;
    const SUBPORTAL_MAIN = 6;
    const NEWS = 7;


    function __construct()
    {
        $this->list = array(
            self::DEF          => 'Без категории',
            self::EVENT        => 'События региона',
            self::THEMES       => 'Сюжеты',
            self::VERB_REPORT  => 'Стенограммы',
            self::ADM          => 'Административное деление',
            self::REGION       => 'Район',
            self::SUBPORTAL_MAIN       => 'Главная страница субпортала',
            self::NEWS         => 'Новости',
        );

        $this->class = array(
            self::DEF          => 'StaticPage',
            self::EVENT        => 'Event',
            self::THEMES       => 'Themes',
            self::VERB_REPORT  => 'VerbReport',
            self::ADM          => 'StaticPage',
            self::REGION       => 'StaticPage',
            self::SUBPORTAL_MAIN => 'StaticPage',
            self::NEWS         => 'NewsModel',
        );
    }
}