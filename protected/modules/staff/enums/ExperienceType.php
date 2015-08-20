<?php

/**
 * Class ExperienceType
 */
class ExperienceType extends Reference
{
    const GOVERNMENT = 'Стаж государственной или муниципальной службы';
    const SPECIAL    = 'Стаж работы по специальности';
    const WITHOUT    = 'Без предъявления';

    function __construct()
    {
        $this->list = array(
            self::GOVERNMENT => 'Стаж государственной или муниципальной службы',
            self::SPECIAL    => 'Стаж работы по специальности',
            self::WITHOUT    => 'Без предъявления',
        );
    }
}