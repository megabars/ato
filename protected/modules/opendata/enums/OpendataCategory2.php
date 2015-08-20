<?php

/**
 * Class OpendataCategory
 */
class OpendataCategory2 extends Reference
{
    const SECURITY      = 1;
    const ELECTION      = 2;
    const GOV_SERVICES  = 3;
    const TRANSPORT     = 4;
    const RELAX         = 5;
    const GKH           = 6;
    const ANIMAL        = 7;
    const MEDICINE      = 8;
    const PROPERTY      = 9;
    const CULTURE       = 10;
    const EDU           = 11;
    const GOV_DEPART    = 12;
    const PEOPLE        = 13;
    const BUSINESS      = 14;
    const COMMUNICATION = 15;
    const SOCIAL        = 16;
    const INFO          = 17;
    const AREA_DIVISION = 18;
    const TRADE         = 19;
    const LABOR         = 20;
    const ROAD          = 21;
    const SPORT         = 22;
    const FINANCE       = 23;


    function __construct()
    {
        $this->list = array(
            self::SECURITY        => 'Безопасность',
            self::ELECTION        => 'Выборы',
            self::GOV_SERVICES    => 'Государственные услуги',
            self::TRANSPORT       => 'Дороги и транспорт',
            self::RELAX           => 'Досуг и отдых',
            self::GKH             => 'Жилищно-коммунальное хозяйство',
            self::ANIMAL          => 'Забота о животных',
            self::MEDICINE        => 'Здравоохранение',
            self::PROPERTY        => 'Земля и имущество',
            self::CULTURE         => 'Культура',
            self::EDU             => 'Образование',
            self::GOV_DEPART      => 'Органы государственной власти',
            self::PEOPLE          => 'Пешеходная инфраструктура',
            self::BUSINESS        => 'Предпринимательство',
            self::COMMUNICATION   => 'Связь',
            self::SOCIAL          => 'Социальная среда',
            self::INFO            => 'Справочная информация',
            self::AREA_DIVISION   => 'Территориальное деление',
            self::TRADE           => 'Торговля',
            self::LABOR           => 'Трудоустройство',
            self::ROAD            => 'Улично-дорожная сеть',
            self::SPORT           => 'Физическая культура и спорт',
            self::FINANCE         => 'Финансы',
        );
    }
}