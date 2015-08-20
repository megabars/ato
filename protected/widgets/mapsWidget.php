<?php

//Yii::import('application.modules.map.models.Maps');
Yii::import('application.modules.people.models.People');

class mapsWidget extends CWidget {
    public $people = false;

    public function init()
    {

    }

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->with = array('mapItem');
        $criteria->order = '"mapItem"."order" ASC';
        $criteria->addCondition('map_id IS NOT NULL');
        $criteria->addCondition('portal_id = 1');

        $page = new StaticPage();
        $regions = $page->allPortalsCriteria()->findAll($criteria);

	$val = People::getTypeGroupLabels(People::GOVERNMENT);
	if ($val == null)
            return;
        $types = array_keys(People::getTypeGroupLabels(People::GOVERNMENT));
        $people = array();

        foreach(People::model()->findAll() as $m)
            if(in_array($m->type,$types))
                $people[$m->type-People::GOVERNMENT]=$m;

        if (NavMenu::model()->findByAttributes(array('alias' => 'map_menu', 'published' => '1')))
            $this->render('application.themes.tomsk.views.main._maps', array(
                'regions' => $regions,
                'people' => $people,
                'peopleUrl' => $this->people,
            ));
    }
}

