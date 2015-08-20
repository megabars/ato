<?php

/**
 * Class ContestState
 */
class ContestState extends Reference
{
    const ACTUAL  = 'Объявленный';
    const PLAN    = 'Планируемый';
    const FINISH  = 'Завершенный';

    function __construct()
    {
        $this->list = array(
            self::ACTUAL     => 'Объявленный',
            self::PLAN       => 'Планируемый',
            self::FINISH     => 'Завершенный',
        );
    }
}