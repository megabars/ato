<?php

/**
 * Class ContestType
 */
class ContestType extends Reference
{
    const VACANT  = 1;
    const STAFF   = 2;
    const WITHOUT = 3;
    const BRANCH  = 4;

    function __construct()
    {
        $this->list = array(
            self::VACANT      => 'Вакантная должность',
            self::STAFF       => 'Кадровый резерв',
            self::WITHOUT     => 'Без конкурса',
            self::BRANCH      => 'Отраслевой резерв',
        );
    }
}