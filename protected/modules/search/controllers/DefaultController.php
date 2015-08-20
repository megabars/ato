<?php

class DefaultController extends Controller
{
    public function init()
    {
        parent::init();

//        $this->registerModuleAssetsScripts(array(), array());
    }


    public function actionIndex($query = null, $logic = 0)
    {
        $totalCount = 0;

        $client = new sphinxclient();
        $client->_host = '192.168.2.2';
//        $client->_host = 'localhost';
        $client->SetMatchMode($logic);
        $client->SetLimits(0, 100000);
        $client->SetArrayResult(true);

        $main = $others = array();

        if ($query)
        {
            $result = $client->Query($query, 'tomsk');

            if (isset($result["matches"]))
            {
                foreach ($result["matches"] as $item)
                {
                    if ($highlightHtml = $client->BuildExcerpts(array($item['attrs']['text']), 'tomsk', $query))
                    {
                        $highlighter = '';
                        foreach ($highlightHtml as $highlightElement)
                            $highlighter = $highlightElement;

                        $data = array(
                            'item_id' => $item['id'],
                            'portal_id' => $item['attrs']['portal_id'],
                            'portal_name' => $item['attrs']['portal_name'],
                            'title' => $item['attrs']['title'],
                            'content_type' => $item['attrs']['content_type'],
                            'url' => SearchContentType::instance()->getUrl($item),
                            'text' => $highlighter,
                        );

                        if ($item['attrs']['portal_id'] == $this->portalId)
                            $main[] = $data;
                        else
                            $others[] = $data;
                    }
                }
            }

            $totalCount = $result['total_found'];
        }

        $per_page = 10;

        // Для основного портала
        $mainPages = new CPagination(count($main));
        $mainPages->pageVar = 'mainPage';
        $mainPages->pageSize = $per_page;

        $mainProvider = new CArrayDataProvider($main, array('keyField' => 'item_id'));
        $mainProvider->setPagination($mainPages);

        // Для остальных порталов
        $othersPages = new CPagination(count($others));
        $othersPages->pageVar = 'otherPage';
        $othersPages->pageSize = $per_page;

        $othersProvider = new CArrayDataProvider($others, array('keyField' => 'item_id'));
        $othersProvider->setPagination($othersPages);

        $this->render('index', array(
            'logic' => $logic,
            'mainProvider' => $mainProvider,
            'othersProvider' => $othersProvider,
            'mainPages' => $mainPages,
            'othersPages' => $othersPages,
            'totalCount' => $totalCount,
            'query' => $query,
        ));
    }
}
