<?php

/**
 * Enum - Класс для работы всех сущностей типа "Document"
 * Class RecordType
 */
class DocumentType extends Reference
{
    const METHODICAL = 1;
    const CERTIFICATE = 2;
    const MEETING = 3;
    const INFO = 4;
    const APPEAL = 5;
    const REASON = 6;
    const RECOMMENDATION = 7;
    const SUPPORT = 8;
    const RESULT = 9;
    const SITUATION = 10;



    function __construct()
    {
        $this->list = array(
            self::METHODICAL        => 'Методические материалы',
            self::CERTIFICATE       => 'Формы справок о доходах и расходах',
            self::MEETING           => 'Материалы заседаний',
            self::INFO              => 'Информационные материалы',
            self::APPEAL            => 'Формы обращений',
            self::REASON            => 'Правовые основания проведения независимой оценки',
            self::RECOMMENDATION    => 'Методические рекомендации',
            self::SUPPORT           => 'Организационное обеспечение в Томской области',
            self::RESULT            => 'Результаты проведения независимой оценки в Томской области',
            self::SITUATION         => 'Положение',
        );
    }
}