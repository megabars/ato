<?php


class NavCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        Yii::app()->getModule('navigation');
        $array = array(
            '/people/front/iogv'=>'Руководство',
            '/people/front/committee'=>'Структурные подразделения',
            '/people/front/terro'=>'Территориальные органы',
            '/people/front/depo'=>'Подведомственные организации',
            '/people/front/coord'=>'Координационные, совещательные органы',
        );

        $i=0;
        foreach($array as $k=>$a)
        {
            $urls = NavItems::model()->findAll("t.title LIKE '$a'");
            foreach($urls as $u)
            {
                $link = UrlManager::model()->findByPk($u->url_id);
                if($link and $link->portal_id!=1)
                {
                    $link->url = $k;
                    $link->save();
                    $i++;
                    echo $i."\n";
                }
            }

        }
    }

    public function actionPeople()
    {
        Yii::app()->getModule('people');

        if($staff = PeopleStaff::model()->findAll())
            foreach($staff as $s)
                if(empty($s->main))
                {
                    $s->main=0;
                    $s->save();
                    echo $s->id."\r";
                }


        echo count(@$staff)."\n";
    }

    public function actionPeople2()
    {
        Yii::app()->getModule('people');
        $i=0;

        if($people = People::model()->findAll())
            foreach($people as $s)
                if(in_array($s->type,array_merge(array_keys(People::getTypeGroupLabels(People::POWER)),array_keys(People::getTypeGroupLabels(People::POWER)))))
                {
                    $s->url  = $s->main_info;
                    $s->save(false);
                    echo $s->id."\r";
                    $i++;
                }


        echo $i."\n";
    }
}