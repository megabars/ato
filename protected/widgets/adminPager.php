<?php

class adminPager extends CLinkPager
{
    public $nextPageLabel = '›';

    public $prevPageLabel = '‹';

    public $firstPageLabel = '«';

    public $lastPageLabel = '»';

    public $htmlOptions = array(
        'id' => 'pagination',
        'class' => 'custom-pager'
    );

    public function run()
    {
        $this->registerClientScript();
        $buttons = $this->createPageButtons();

        if (empty($buttons))
        {
            return;
        }

        echo CHtml::tag('ul', $this->htmlOptions, implode("\n", $buttons));
    }
}