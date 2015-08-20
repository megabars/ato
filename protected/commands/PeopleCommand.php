<?php

class PeopleCommand extends CConsoleCommand {

    public function actionIndex(){

        Yii::app()->getModule('people');

        People::getTypeGroupLabels(People::OTHER_POWER);

        while(true)
        {
            $model=new PeopleGroup();
            $model->save();
            if($model->id>People::OTHER_POWER_REPRESENTATIONS)
                break;
        }

        foreach(PeopleGroup::$labels as $k=>$l)
        {
            $group = People::getTypeGroupLabels($k);
            foreach($group as $gk=>$gv)
            {
                if(!$model=PeopleGroup::model()->findByPk($gk))
                {
                    $model=new PeopleGroup();
                    $model->id = $gk;
                }
                $model->group_id = $k;
                $model->title = $gv;
                $model->save();
            }
            unset($group);
        }

        $peopleGroup =  PeopleGroup::model()->findAll();

        foreach($peopleGroup as $p)
            if(empty($p->title) and $p->group_id==1)
                $p->delete();
    }
}