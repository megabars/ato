<?php

/**
 * Class Widgets
 */
class Widgets extends Reference
{
    const INFOPOTOK    = 1;

    function __construct()
    {
        $this->list = array(
            self::INFOPOTOK     => 'Модуль инфопоток',
        );
    }
}