<?php
/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 27.02.15
 * Time: 15:08
 */

class RatingDefaultFile extends Reference{

    public function __construct(){
        $this->list = array(
            RatingGlobalType::GLOBAL_TYPE_PROJECT => array(
                0 => array(
                    'title' => 'Уведомление об обсуждении идеи (концепции)',
                    'description' => 'Срок приема предложений с 01.01.2015 по 01.01.2015
Адрес для направления предложений: ___________@tomsk.gov.ru',
                ),
                array(
                    'title' => 'Сводный отчет',
                    'description' => '',
                ),
                array(
                    'title' => 'Проект акта',
                    'description' => '',
                ),
                array(
                    'title' => 'Уведомление о проведении публичных консультаций',
                    'description' => 'Срок приема предложений с 01.01.2015 по 01.01.2015
Адрес для направления предложений: ___________@tomsk.gov.ru',
                ),
            ),
            RatingGlobalType::GLOBAL_TYPE_PROJECT_EXPERT => array(
                0 => array(
                    'title' => 'Уведомление о проведении публичных консультаций',
                    'description' => 'Срок проведения публичных консультаций с 01.01.2015 по 01.01.2015',
                ),
                array(
                    'title' => 'Проект заключения',
                    'description' => 'об экспертизе закона Томской области',
                ),
                array(
                    'title' => 'Уведомление о проведении публичных консультаций',
                    'description' => 'в отношении проекта заключения
Срок проведения публичных консультаций 01.01.2015 по 01.01.2015',
                ),
                array(
                    'title' => 'Заключение',
                    'description' => 'об экспертизе закона Томской области',
                ),
            ),
        );
    }

}