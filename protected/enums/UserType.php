<?php

/**
 * Class UserType
 */
class UserType extends Reference
{
    const ADMIN       = 1;
    const EDITOR      = 2;
    const USER        = 3;

    function __construct()
    {
        $this->list = array(
            self::ADMIN        => 'Администратор',
            self::EDITOR       => 'Модератор',
            self::USER         => 'Пользователь',
        );
    }
}