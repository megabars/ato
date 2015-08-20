<?php

class customPager extends CLinkPager
{
    public $cssFile = '';

    public $selectedPageCssClass = 'active';

    public $nextPageLabel = 'Следующая <span class="ico"></span>';

    public $prevPageLabel = '<span class="ico"></span> Предыдущая';

    public $firstPageLabel = ' ';

    public $lastPageLabel = ' ';

    public $htmlOptions = array(
        'class' => 'pagination'
    );

    public function init()
    {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);

        $this->cssFile = $baseUrl . '/css/pager.css';

        parent::init();
    }

    /**
     * Creates the page buttons.
     * @return array a list of page buttons (in HTML code).
     */
    protected function createPageButtons()
    {
        if (($pageCount = $this->getPageCount()) <= 1)
            return array();

        list($beginPage, $endPage) = $this->getPageRange();
        $currentPage = $this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons = array();

        // first page
//        $buttons[] = $this->createPageButton($this->firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);

        // prev page
        if (($page = $currentPage - 1) < 0)
            $page = 0;
        $buttons[] = $this->createPageButton($this->prevPageLabel, $page, $this->previousPageCssClass, $currentPage <= 0, false);

        // internal pages
        for ($i = $beginPage; $i <= $endPage; ++$i)
            $buttons[] = $this->createPageButton($i + 1, $i, $this->internalPageCssClass, false, $i == $currentPage);

        // next page
        if (($page = $currentPage + 1) >= $pageCount - 1)
            $page = $pageCount - 1;
        $buttons[] = $this->createPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);

        // last page
//        $buttons[] = $this->createPageButton($this->lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);

        return $buttons;
    }
    
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