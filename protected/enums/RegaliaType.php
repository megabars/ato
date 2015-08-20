<?php

/**
 * Enum - Класс для работы всех сущностей типа "Regalia"
 * Class RegaliaType
 */
class RegaliaType extends Reference
{
    const DEGREE   = 1;
    const ACADEMIC = 2;
    const HONORARY = 3;

    function __construct()
    {
        $this->list = array(
            self::DEGREE   => 'Ученая степень',
            self::ACADEMIC => 'Ученая звания',
            self::HONORARY => 'Почетное звание (степень)',
        );
    }
}