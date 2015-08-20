<?php

/**
 * Class EducationLevel
 */
class EducationLevel extends Reference
{
    const MAIN    = 'Среднее';
    const HIGHER  = 'Высшее';

    function __construct()
    {
        $this->list = array(
            self::MAIN    => 'Среднее',
            self::HIGHER  => 'Высшее',
        );
    }
}