<?php

/**
 * Class VacancyGroup
 */
class VacancyGroup extends Reference
{
    const HIGH    = 'Высшая';
    const MAIN    = 'Главная';
    const LEAD    = 'Ведущая';
    const OLD     = 'Старшая';
    const YOUNG   = 'Младшая';

    function __construct()
    {
        $this->list = array(
            self::HIGH    => 'Высшая',
            self::MAIN    => 'Главная',
            self::LEAD    => 'Ведущая',
            self::OLD     => 'Старшая',
            self::YOUNG   => 'Младшая',
        );
    }
}