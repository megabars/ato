<?php
/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 27.02.15
 * Time: 14:46
 */

class RatingGlobalType extends Reference
{
    const GLOBAL_TYPE_INFO              = 1;
    const GLOBAL_TYPE_CONCLUSION        = 2;
    const GLOBAL_TYPE_MONITORING        = 3;
    const GLOBAL_TYPE_EXPERT_PLAN       = 4;

    const GLOBAL_TYPE_PROJECT           = 5;
    const GLOBAL_TYPE_PROJECT_EXPERT    = 6;

    function __construct()
    {
        $this->listDoc = array(
            self::GLOBAL_TYPE_INFO             => 'Информационные материалы',
            self::GLOBAL_TYPE_CONCLUSION       => 'Заключения об ОРВ',
            self::GLOBAL_TYPE_MONITORING       => 'Мониторинг фактического воздействия НПА',
            self::GLOBAL_TYPE_EXPERT_PLAN      => 'План экспертизы',

        );

        $this->listProject = array(
            self::GLOBAL_TYPE_PROJECT          => 'Публичные консультации',
            self::GLOBAL_TYPE_PROJECT_EXPERT   => 'Экспертиза НПА',

        );

        $this->listProjectIds = array(
            self::GLOBAL_TYPE_PROJECT,
            self::GLOBAL_TYPE_PROJECT_EXPERT
        );

        $this->listCommon = $this->listDoc + $this->listProject;
    }
}
