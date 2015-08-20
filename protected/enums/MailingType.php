<?php

/**
 * Enum - Класс для работы всех сущностей типа "People"
 * Class RecordType
 */
class MailingType extends Reference
{
    const MAIN = 1;
    const GROUP = 2;
    const EMAILS = 3;
    const TEMPLATE = 4;


    function __construct()
    {
        $this->list = array(
            self::MAIN             => array('url'=>'/mailing/mailSubscribe/','label'=>'Рассылки'),
            self::GROUP           => array('url'=>'/mailing/mailGroup','label'=>'Группы'),
            self::EMAILS           => array('url'=>'/mailing/mailEmailList','label'=>'Подписчики'),
            self::TEMPLATE           => array('url'=>'/mailing/mailTemplate','label'=>'Шаблоны'),
        );
    }
}