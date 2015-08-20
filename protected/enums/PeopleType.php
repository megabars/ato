<?php

/**
 * Enum - Класс для работы всех сущностей типа "People"
 * Class RecordType
 */
class PeopleType extends Reference
{
    const MAIN = 1;
    const STAFF = 2;
    const UNIT = 3;
    const LIFE = 4;
    const MAIN_INFO = 5;
    const CONTACTS = 6;


    function __construct()
    {
        $this->list = array();
    }
}