<?php

/**
 * Class EducationDirection
 */
class EducationDirection extends Reference
{
    const ECONOMIC    = 'Экономика и управление';
    const GOVERNMENT  = 'Государственное и муниципальное управление';
    const LEGAL       = 'Юридическое';
    const TECHNICAL   = 'Инженерно-техническое';
    const OTHER       = 'Иное';

    function __construct()
    {
        $this->list = array(
            self::ECONOMIC    => 'Экономика и управление',
            self::GOVERNMENT  => 'Государственное и муниципальное управление',
            self::LEGAL       => 'Юридическое',
            self::TECHNICAL   => 'Инженерно-техническое',
            self::OTHER       => 'Иное',
        );
    }
}