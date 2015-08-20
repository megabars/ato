<?php

class SearchContentType extends Reference
{
    const PAGE     = 'page';
    const NEWS     = 'news';
    const OPENDATA = 'opendata';
    const PEOPLE   = 'people';
    const VIDEO    = 'video';

    function __construct()
    {
        $this->list = array(
            self::PAGE      => 'Страница',
            self::NEWS      => 'Новости',
            self::OPENDATA  => 'Открытые данные',
            self::PEOPLE    => 'Персоналии',
            self::VIDEO     => 'Видеогалерея',
        );
    }

    public function getUrl($item)
    {
        $url = '';

        $prefix = 'http://' . $item['attrs']['portal_alias'];

        switch($item['attrs']['content_type'])
        {
            case self::NEWS:
                $url = Yii::app()->createUrl('/news/front/view', array('id' => $item['id']));
                break;
            case self::OPENDATA:
                $url = Yii::app()->createUrl('/opendata/front/view', array('id' => $item['id']));
                break;
            case self::PEOPLE:
                $url = Yii::app()->createUrl('/people/front/index', array('id' => $item['id']));
                break;
            case self::VIDEO:
                $url = Yii::app()->createUrl('/video/front/view');
                break;
            case self::PAGE:
                $url = Yii::app()->createUrl($item['attrs']['url']);
                break;
        }

        return $prefix . $url;
    }
}