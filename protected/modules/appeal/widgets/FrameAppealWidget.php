<?php

Yii::app()->getModule('news');

class FrameAppealWidget extends CWidget
{
    public $antiCorruption = false;

    protected $portalCode = 'adm';

    protected $queryParams;

    public function init()
    {
        $portalCode = Portal::model()->findByPk(Yii::app()->controller->portalId)->code;

        if(!empty($portalCode))
            $this->portalCode = $portalCode;

        $this->queryParams = '?url='.$this->portalCode;

        if($this->antiCorruption)
            $this->queryParams .= '&corrupt=1';
    }

    public function run()
    {
        echo '<iframe src="http://appeals.esp.tomsk.gov.ru/'.$this->queryParams.'" height="900" style="width: 760px;" frameborder="0" allowtransparency="true" allowfullscreen="true"></iframe>';
    }
}