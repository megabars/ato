<?php

class LinksUpdateCommand extends CConsoleCommand
{
    public $controller = array('portalId'=>1);
    function actionIndex()
    {
        $arr = array(
            'Информационные системы' => 'information-system',
            'Проверки' => 'proverki',
            'Статистика' => 'statistica',
            'Аукционы и конкурсы' => 'auc-i-konkursi',
        );

        foreach (Portal::model()->findAll() as $item)
        {
            foreach ($arr as $label => $elem)
            {
                $manager = new UrlManager();
                $manager->url = $elem;
                $manager->portal_id = $item->id;
                $manager->title = $label;

                if ($manager->save())
                {
                    $page = new StaticPage();
                    $page->url_id = $manager->id;
                    $page->portal_id = $item->id;
                    $page->title = $label;
                    $page->state = 1;
                    $page->date = time();
                    $page->save();
                }
            }
        }
    }

    public function actionPeople()
    {
        $model = People::model()->findAll('office_type_id!=0');
        if($model)
            foreach($model as $m)
            {
                $m->type = ($m->office_type_id==10)?50:$m->office_type_id+20;
                $m->office_type_id = 0;
                $m->save(false);
            }
    }
}