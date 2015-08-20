<?php

/**
 * Enum - Класс для работы всех сущностей типа "Contact"
 * Class RecordType
 */
class ContactType extends Reference
{
    const PHONE   = 1;
    const FAX     = 2;
    const HOTLINE = 3;
    const EMAIL   = 4;
    const WEB     = 5;
    const BLOG    = 6;
    const SOCIAL  = 7;


    function __construct()
    {
        $this->list = array(
            self::PHONE   => 'Телефон',
            self::FAX     => 'Факс',
            self::HOTLINE => 'Горячая линия',
            self::EMAIL   => 'E-mail',
            self::WEB     => 'Сайт',
            self::BLOG    => 'Блог',
            self::SOCIAL  => 'Социальная сеть',
        );
    }
}