<?php

class FrontController extends Controller
{
    /**
     * @todo не убираю не нужные $pages (категории новостей в админке) чтоб не сломалось все, $pages и категории новостей убить
     */
    public function actionIndex($dateBegin = null, $dateEnd = null, $search = null)
    {
        $criteria = new CDbCriteria();

        if($dateBegin && $timeDateBegin = strtotime($dateBegin))
        {
            $startDay = date('d', $timeDateBegin);
            $startMonth = date('m', $timeDateBegin);
            $startYear = date('Y', $timeDateBegin);

            $timeDateBegin = strtotime("{$startDay}-{$startMonth}-{$startYear} 00:00:00");

            $criteria->addCondition("t.date >= {$timeDateBegin}");
        }

        if($dateEnd && $timeDateEnd = strtotime($dateEnd))
        {
            $endDay = date('d', $timeDateEnd);
            $endMonth = date('m', $timeDateEnd);
            $endYear = date('Y', $timeDateEnd);

            $timeDateEnd = strtotime("{$endDay}-{$endMonth}-{$endYear} 23:59:59");

            $criteria->addCondition("t.date <= {$timeDateEnd}");
        }


        if($search)
        {
            $search = trim($search);
            $criteriaSearch = new CDbCriteria();
            $criteriaSearch->addSearchCondition('t.description', $search , true, 'OR', 'ILIKE');
            $criteriaSearch->addSearchCondition('t.preview', $search , true, 'OR', 'ILIKE');
            $criteriaSearch->addSearchCondition('t.title', $search , true, 'OR', 'ILIKE');

            $criteriaSearch->with = array('url');
            $criteriaSearch->together = false;
            $criteriaSearch->addSearchCondition('url.meta_keywods', $search, true, 'OR', 'ILIKE');
            $criteriaSearch->addSearchCondition('url.meta_description', $search, true, 'OR', 'ILIKE');
            $criteriaSearch->addSearchCondition('url.title', $search, true, 'OR', 'ILIKE');

            $criteria->mergeWith($criteriaSearch, 'AND');
        }


        $count = Smi::model()->published()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $this->render('index', array(
            'records' => Smi::model()->sorted()->published()->findAll($criteria),
            'pages' => $pages,
            'dateBegin' => $dateBegin,
            'dateEnd' => $dateEnd,
            'search' => $search,
        ));
    }

    public function actionView($id)
    {
        if (!$record = Smi::model()->findByPk($id))
            $this->errorTo('/smi/front', 'Запись не найдена');

        $this->render('view', array(
            'record' => $record,
        ));
    }
}