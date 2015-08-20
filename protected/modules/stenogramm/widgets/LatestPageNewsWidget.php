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

    public function init()
    {
        $this->dataProvider = News::model()->limit($this->limit)->sorted()->alias($this->alias)->published()->search();
        parent::init();
    }

    public function run()
    {
        parent::run();
        echo '<div class="foot clearfix"><a href="/news/front" class="fr">Все новости</a></div>';
    }
}