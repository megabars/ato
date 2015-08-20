<?php

Yii::app()->getModule('news');
Yii::import('zii.widgets.CListView');

class LatestPageNewsWidget extends CListView
{
    public $limit = 6;
    public $alias = '';
    public $itemsTagName = 'ul';
    public $itemView = 'application.themes.tomsk.views.main._news';
    public $htmlOptions = array(
        'class'=>'last-news last-news-full'
    );
    public $pager = array(
        'cssFile' => false,
        'header' => '',
        'lastPageLabel' => false
    );

    public function init()
    {
        $criteria = new CActiveDataProvider('News',array(
            'sort'=>array(
                'defaultOrder'=>'id desc',
            ),
            'pagination'=>array(
                'pageSize'=>6,
            ),
        ));

        $this->dataProvider = News::model()->limit($this->limit)->sorted()->alias($this->alias)->published()->search();
        $this->dataProvider = $criteria;
        parent::init();
    }

    public function run()
    {
        parent::run();
        echo '<div class="foot clearfix"><a href="/news/front" class="fr">'.Yii::t('app', 'Все новости').'</a></div>';
    }
}