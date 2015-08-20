<?php

class RatingLocalType extends Reference{


    function __construct()
    {
        $this->list = array(
            RatingGlobalType::GLOBAL_TYPE_INFO => array(
                0 => 'нормативно-правовые акты',
                1 => 'методические рекомендации',
                2 => 'соглашения  и иные документы'
            ),
            RatingGlobalType::GLOBAL_TYPE_CONCLUSION => array(
                0 => 'протокол',
                1 => 'заключение',
                2 => 'справка',
            ),
            RatingGlobalType::GLOBAL_TYPE_MONITORING => array(),
            RatingGlobalType::GLOBAL_TYPE_EXPERT_PLAN => array(
                0 => 'Уведомление о формировании плана проведения экспертизы НПА',
                1 => 'Предложения для включения в план проведения экспертизы НПА',
                2 => 'Распоряжение Губернатора Томской области «Об утверждении Плана проведения экспертизы НПА»',
            ),
            RatingGlobalType::GLOBAL_TYPE_PROJECT => array(
                0 => 'проект федеральных НПА',
                1 => 'проект НПА Томской области',
            ),
            RatingGlobalType::GLOBAL_TYPE_PROJECT_EXPERT => array(),

        );
    }
}