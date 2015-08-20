<?php

/**
 * Class VacancyCategory
 */
class VacancyCategory extends Reference
{
    const MANAGE   = 'Руководители';
    const SPECIAL  = 'Специалисты';
    const STAFF    = 'Обеспечивающие специалисты';

    function __construct()
    {
        $this->list = array(
            self::MANAGE    => 'Руководители',
            self::SPECIAL   => 'Специалисты',
            self::STAFF     => 'Обеспечивающие специалисты',
        );
    }
}