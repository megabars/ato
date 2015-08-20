<?php

/**
 * Class StatusType
 */
class StatusType extends Reference
{
    const PUBLISH    = "1";
    const DRAFT      = "0";
    const PLANED     = "2";

    function __construct()
    {
        $this->list = array(
            self::PUBLISH     => 'Опубликовать сразу',
            self::DRAFT       => 'Черновик',
            self::PLANED      => 'Запланированно на',
        );
    }
}