<?php

class customPager extends CLinkPager
{
    public $nextPageLabel = 'Следующая&nbsp;&nbsp;&rarr;';

    public $prevPageLabel = '&larr;&nbsp;&nbsp;Предыдущая';

    public $firstPageLabel = '&larr;&nbsp;&nbsp;Первая';

    public $lastPageLabel = 'Последняя&nbsp;&nbsp;&rarr;';

    public $cssFile = false;

    public $htmlOptions = array(
        'class' => 'pager'
    );

    public function run()
    {
        $this->registerClientScript();
        $buttons = $this->createPageButtons();

        if (empty($buttons))
            return;
        echo CHtml::openTag('div', $this->htmlOptions);
        echo CHtml::tag('ul', array(), implode("\n", $buttons));
        echo CHtml::closeTag('div');
    }
}