<?php
/**
 * author: Mikhail Matveev
 * Date: 19.03.15
 */

class ImportCommand extends CConsoleCommand
{

    protected $url = 'http://cms.esp.tomsk.gov.ru/nodes/tgr/ru/dokumenty/normativno-pravovye-akty.json';
    protected $executive_id;
    protected $portal_id;
    protected $type_doc = array(
        'Устав' => 1025,
        'Закон' => 911,
        'Приказ' => 910,
        'Распоряжение' => 909
    );
    public function actionTruncate()
    {
        $foldersGroup = FoldersGroup::model()->findByAttributes(array('alias' => 'main', 'portal_id' => 1));

        if (!is_array($foldersGroup->folders))
            return;

        echo "Im main folder found " . count($foldersGroup->folders) . " types\n";

        foreach ($foldersGroup->folders as $folder) {

            if (is_array($folder->documents)) {
                echo "in folder found " . count($folder->documents) . " documents\n";

                foreach ($folder->documents as $doc) {
                    $doc->realDelete();
                }
            }

            $folder->realDelete();
        }
    }

    protected function makeFileRecord($document)
    {
        $content = $this->getData($document['attachment_url'], false);
        $tmp = explode('.', $document['attachment_url']);
        $ext = strtolower(end($tmp));
        $fileName = sha1(uniqid()) . '.' . $ext;

        $tmp = explode('/', $document['attachment_url']);
        $originName = end($tmp);

        $fp = fopen(Yii::app()->basePath . '/../public/uploads/1/' . $fileName, 'w+');

        if (fwrite($fp, $content) === false) {
            echo "\nCant save file to path: " . Yii::app()->basePath . '/../public/uploads/1/' . $fileName;
            return false;
        }

        $file = new File();

        $file->attributes = array(
            'portal_id' => 1,
            'origin_name' => $originName,
            'name' => $fileName,
            'size' => filesize(Yii::app()->basePath . '/../public/uploads/1/' . $fileName),
            'ext' => $ext,
            'date' => isset($document['published_on']) ? strtotime($document['published_on']) : time(),
        );

        if (!$file->save()) {
            echo "Cant save file error is: " . print_r($file->getErrors(), 1);
            return false;
        }

        return $file;
    }

    public function actionSmi($startPage =1) {
        $url = 'http://cms.esp.tomsk.gov.ru/nodes/tgr/ru/press-centr/tomskaya-oblast-v-smi.json';
        $data = $this->getData($url);

        $data = $data['page']['regions']['content_first']['content'];
        $pages = $data['pagination']['total_count'] / 10 + 1;

        for ($i = $startPage; $i <= $pages; $i++) {

            $pageUrl = $url . '?page=' . $i;

            $data = $this->getData($pageUrl . '?page=' . $i);
            $data = $data['page']['regions']['content_first']['content'];

            echo "Parsing url {$pageUrl}, count of docs is " . count($data['items']) . "\n";

            foreach ($data['items'] as $item){
                $model = new Smi();

                if (isset($item['images']) && count($item['images']) == 1) {
                    $img = $item['images'][0];

                    $imageModel = $this->makeFileRecord(array(
                        'attachment_url' => $img['url'],


                    ));

                    $model->photo = $imageModel->id;
                    $model->photo_title = $img['description'];
                } elseif (count($item['images']) > 1) {
                    $det = 1;
                }


                $model->attributes = array(
                    'portal_id' => 1,
                    'date' => strtotime($item['since']),
                    'title' => $item['title'],
                    'preview' => $item['annotation'],
                    'description' => $item['body'],
                    'state' => 1,
                    'source' => $item['source'],
                    'source_link' => $item['source_link']
                );


                if (!$model->save())
                    echo "Cant save Afisha model " . print_r($model->getErrors(), 1);

            }
        }


                $a = 1;

    }

    public function actionEventsCalendar($startPage = 1){
        $url = 'http://cms.esp.tomsk.gov.ru/nodes/tgr/ru/press-centr/kalendar-meropriyatiy/archive.json';

        $data = $this->getData($url);
        $data = $data['page']['regions']['content_first']['content'];
        $pages = $data['pagination']['total_count'] / 10 + 1;

        for ($i = $startPage; $i <= $pages; $i++) {

            $pageUrl = $url . '?page=' . $i;

            $data = $this->getData($pageUrl . '?page=' . $i);
            $data = $data['page']['regions']['content_first']['content'];

            echo "Parsing url {$pageUrl}, count of docs is " . count($data['items']) . "\n";

            foreach ($data['items'] as $event) {
//                $exName = trim(str_replace('Томской области', '', $event['title']));
//                $executive = Executive::model()->findByAttributes(array('name' => $exName));
//
//                if ($executive === null) {
//                    echo "Executive with name {$exName} not found\n";
//                    continue;
//                }
//                $file = $this->makeFileRecord($document);
//                if ($file === false) {
//                    echo "Something wring with file record! Data not saved\n";
//                    continue;
//                }

                $prop = array();
                if (isset($event['event_entry_properties']) && count($event['event_entry_properties']) == 1) {
                    $prop = $event['event_entry_properties'][0];
//                    $place = $event['event_entry_properties']['location'];
                } elseif (count($event['event_entry_properties']) > 1) {
                    echo "Event property is bigger than simple array()\n";
                    continue;
                }


//                $model = new Afisha();
                $model = modelFactory::get("Afisha", array('title' => $event['title'], 'date' => strtotime($prop['since'])));
                if ($model->isNewRecord) {
                    $model->attributes = array(
                        'portal_id' => 1,
                        'state' => 1,
                        'title' => $event['title'],
                        'place' => $prop['location'],
                        'organizer' => ($event['author'] === null) ? 'Администрация Томской области' : $event['author'],
                        'preview' => $event['annotation'],
                        'description' => $event['body'],
                        'date' => strtotime($prop['since']),
                        'state_date'=>strtotime($prop['since']),
                        'duration' => strtotime($prop['until']),
                    );

                    if (!$model->save())
                        echo "Cant save Afisha model " . print_r($model->getErrors(), 1);

                }

                $a = 2;
            }
        }

    }

    public function actionProjectsNpa($url = null, $startPage = 1)
    {

        if ($url === null)
            $url = 'http://cms.esp.tomsk.gov.ru/nodes/tgr/ru/dokumenty/proekty-normativnyh-dokumentov.json';


        $data = $this->getData($url);

        $data = $data['page']['regions']['content_second']['content'];
        $pages = $data['pagination']['total_count'] / 20 + 1;

        for ($i = $startPage; $i <= $pages; $i++) {

            $pageUrl = $url . '?page=' . $i;

            $data = $this->getData($pageUrl . '?page=' . $i);
            $data = $data['page']['regions']['content_second']['content'];

            echo "Parsing url {$pageUrl}, count of docs is " . count($data['papers']) . "\n";

            foreach ($data['papers'] as $document) {
                $exName = trim(str_replace('Томской области', '', $document['authority']));
                $executive = Executive::model()->findByAttributes(array('name' => $exName));

                if ($executive === null) {
                    echo "Executive with name {$exName} not found\n";
                    continue;
                }

                $file = $this->makeFileRecord($document);

                if ($file === false) {
                    echo "Something wring with file record! Data not saved\n";
                    continue;
                }


                $docModel = new Npa();
                $docModel->attributes = array(
                    'portal_id' => 1,
                    'title' => $document['title'],
                    'type' => $document['kind'],
                    'date_publish' => strtotime($document['published_on']),
                    'file' => $file->id,
                    'executive_id' => $executive->id
                );

                if (!$docModel->save())
                    echo "Cant save doc model " . print_r($docModel->getErrors(), 1);


            }
        }


    }

    public function actionNormative($startPage = 1)
    {
        $data = $this->getData($this->url);
        $data = $data['page']['regions']['content_first']['content'];

        $pages = $data['pagination']['total_count'] / 20 + 1;

        $foldersGroup = FoldersGroup::model()->findByAttributes(array('alias' => 'main', 'portal_id' => 1));

        for ($i = $startPage; $i <= $pages; $i++) {

            $url = $this->url . '?page=' . $i;
            $data = $this->getData($this->url . '?page=' . $i);
            $data = $data['page']['regions']['content_first']['content'];

            echo "Parsing url {$url}, count of docs is " . count($data['papers']) . "\n";

            foreach ($data['papers'] as $document) {
                // документ закреплен за ИОГВ
                $exName = trim(str_replace('Томской области', '', $document['authority']));
                $executive = Executive::model()->findByAttributes(array('name' => $exName));

                if ($executive === null) {
                    echo "Executive with name {$exName} not found\n";
                    continue;
                }
//                continue;

                /** @var $folder DocumentsFolder */
                $folder = modelFactory::get('DocumentsFolder', array('title' => $document['kind']));
                if ($folder->isNewRecord) {
                    $folder->group_id = $foldersGroup->id;
                    $folder->state = 1;
                    $folder->save();
                }

                $file = new File();

                // возможно самый гемор, получаем и записывыем файл
                $content = $this->getData($document['attachment_url'], false);
                $tmp = explode('.', $document['attachment_url']);
                $ext = strtolower(end($tmp));
                $fileName = sha1(uniqid()) . '.' . $ext;

                $tmp = explode('/', $document['attachment_url']);
                $originName = end($tmp);

                $fp = fopen(Yii::app()->basePath . '/../public/uploads/1/' . $fileName, 'w+');

                if (fwrite($fp, $content) === false) {
                    echo "\nCant save file to path: " . Yii::app()->basePath . '/../public/uploads/1/' . $fileName;
                    continue;
                }


                $file->attributes = array(
                    'portal_id' => 1,
                    'origin_name' => $originName,
                    'name' => $fileName,
                    'size' => filesize(Yii::app()->basePath . '/../public/uploads/1/' . $fileName),
                    'ext' => $ext,
                    'date' => strtotime($document['published_on'])
                );

                if (!$file->save()) {
                    echo "Cant save file error is: " . print_r($file->getErrors(), 1);
                }

                $docModel = new Documents();
                $docModel->attributes = array(
                    'folder_id' => $folder->id,
                    'title' => $document['title'],
                    'date_public' => strtotime($document['published_on']),
                    'date_real' => strtotime($document['approved_on']),
                    'public' => 1,
                    'number' => $document['number'],
                    'executive_id' => $executive->id
                );

                switch ($file->ext) {
                    case 'pdf':
                        $docModel->pdf = $file->id;
                        break;

                    case 'docx':
                    case 'doc':
                        $docModel->doc = $file->id;
                        break;

                    case 'zip':
                        $docModel->zip = $file->id;
                        break;

                    default:
                        echo "File extension is {$file->ext}\n";
                        continue;
                        break;
                }

                try {
                    if (!$docModel->save())
                        echo "Cant save doc model " . print_r($docModel->getErrors(), 1);
                } catch (Exception $e) {
                    print_r($e);
                }

            }

            echo "page {$i} done\n";
//            if ($i == 5)
//                die;
        }

    }

    public function actionZdrav() {
        $this->executive_id = 39;
        $this->portal_id = 290;

        // сохраняем документы для комитета здравоохранения
        if (!file_exists(Yii::app()->basePath . "/../public/uploads/".$this->portal_id)) {
            mkdir(Yii::app()->basePath . "/../public/uploads/".$this->portal_id);
        }

        Yii::import('ext.simple_html_dom');
        $simpleHTML = new simple_html_dom;

        $this->url = 'http://zdrav.tomsk.ru';
        // получаем количество страниц
        $data = $this->getData($this->url.'/ru/dokumenty/normativno-pravovye-akty', false);
        $html = str_get_html($data);

        foreach ($html->find('div.pagination>span.page') as $element)
        {
            $maxPage = $element->plaintext;
        }

        // для каждой страницы из пейджинга получаем список ссылок на страницы с документами
        for ($i = 1; $i <= $maxPage; $i++)
        {
            $url = $this->url.'/ru/dokumenty/normativno-pravovye-akty?page='.$i;

            echo "Parsing url {$url}, count of pages is " . $maxPage . "\n";

            $data = $this->getData($url, false);
            $html = str_get_html($data);
            // проходим по каждой ссылке и получаем документ
            foreach ($html->find('a.icon') as $element)
            {
                $data = $this->getData($this->url.$element->href, false);
                $doc = str_get_html($data);

                $tmp = $doc->find('div.col-xs-9', 0)->plaintext;
                $tmp = trim(str_replace('Департамент здравоохранения Томской области,', '', $tmp));
                $tmp = explode(" ", $tmp);
                $tmp = array_values(array_filter($tmp));

                $document['title'] = $doc->find('h1', 2)->plaintext;
                $document['number'] = str_replace('№', '', $tmp[1]);
                $document['published_on'] = str_replace(',','', $tmp[3]);
                $document['approved_on'] = $tmp[5];
                $document['attachment_url'] = $doc->find('a.icon', 0)->href;
                $document['kind'] = mb_strtoupper(mb_substr($tmp[0], 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($tmp[0], 1, mb_strlen($tmp[0]), 'UTF-8');

                $this->saveDocs($document); // сохраняем документ
            }
        }
    }

    public function actionZdrav2()
    {
        $this->executive_id = 39;
        $this->portal_id = 290;

        // сохраняем документы для комитета здравоохранения
        if (!file_exists(Yii::app()->basePath . "/../public/uploads/".$this->portal_id)) {
            mkdir(Yii::app()->basePath . "/../public/uploads/".$this->portal_id);
        }

        Yii::import('ext.simple_html_dom');
        $simpleHTML = new simple_html_dom;

        $this->url = 'http://zdrav.tomsk.ru/ru/dokumenty/normativno-pravovye-akty-na-federalnom-i-regionalnom-urovne';
        $data = $this->getData($this->url, false);
        $html = str_get_html($data);

        $i = 0;
        foreach ($html->find("a.icon") as $element)
        {
            $document['attachment_url'] = $element->href;
            $tmp = explode("/", $element->href);

            if (!strpos(array_pop($tmp), '.')) {
                unset($document['attachment_url']);
                $document['note'] = $element->href;
            }

            $document['title'] = str_replace(array( '&laquo;', '&raquo;'), '', $element->plaintext);
            $tmp = explode(' ', trim($html->find("span.text-muted", $i)->plaintext));
            $document['kind'] = $tmp[0];
            foreach ($tmp as $t)
            {
                if (preg_match('/(\d){2}.(\d){2}.(\d){4}/', $t)) {
                    $document['published_on'] = $t;
                    $document['approved_on'] = $document['published_on'];
                }
            }
            $document['number'] = str_replace('№', '', array_pop($tmp));

            $this->saveDocs($document); // сохраняем документ
            $i++;
        }

    }

    public function actionObrazov()
    {
        $this->executive_id = 38;
        $this->portal_id = 272;

        // сохраняем документы для комитета здравоохранения
        if (!file_exists(Yii::app()->basePath . "/../public/uploads/".$this->portal_id)) {
            mkdir(Yii::app()->basePath . "/../public/uploads/".$this->portal_id);
        }

        Yii::import('ext.simple_html_dom');
        $simpleHTML = new simple_html_dom;

        $this->url = 'http://edu.tomsk.gov.ru';
        $data = $this->getData($this->url.'/index.php?option=com_k2&view=itemlist&layout=category&task=category&id=26&Itemid=41', false);
        $html = str_get_html($data);

        foreach ($html->find('div.subCategory>h2 a') as $element)
        {
            $data = $this->getData($this->url.$element->href, false);
            $doc = str_get_html($data);

            // проверка на ссылки на документы

            if ($doc->find('div p a', 0)) {
                foreach ($doc->find('div p') as $d)
                {
                    $tmp = str_replace(array('Просмотреть документ', 'Департамента общего образования Томской области от'), '', $d->plaintext);
                    $tmp = explode(" ", $tmp);
                    $tmp = array_values(array_filter($tmp));
                    $document = array();
                    $document['kind'] = trim($tmp[0]);
                    $document['number'] = $tmp[3];
                    $document['published_on'] = str_replace('г.', '', $tmp[1]);
                    $document['approved_on'] = $document['published_on'];

                    unset($tmp[0]);
                    unset($tmp[1]);
                    unset($tmp[2]);
                    unset($tmp[3]);

                    $document['title'] = implode(' ', $tmp);

                    $data = $this->getData($this->url.$d->find('a', 0)->href, false);
                    $doc2 = str_get_html($data);
                    $document['attachment_url'] = $this->url.$doc2->find('a.wf_file', 0)->href;

                    $this->saveDocs($document);
                }
            }
            // конец проверки на ссылки

            // нужно проверить на подкатегории

            if ($doc->find('div.subCategory>h2 a', 0)) {
                foreach ($doc->find('h2 a') as $element2) {
                    $data = $this->getData($this->url.$element2->href, false);
                    $doc2 = str_get_html($data);

                    $pageArr = array();
                    $pageArr[] = $element2->href;

                    // проверка на пейджинг
                    if ($doc2->find('span.pagination', 0)) { // WORKS
                        foreach ($doc2->find('span.pagination a') as $p)
                        {
                            if (!in_array($p->href, $pageArr)) {
                                $pageArr[] = $p->href;
                            }
                        }
                    }

                    foreach ($pageArr as $page)
                    {
                        $data = $this->getData($this->url.$page, false);
                        $doc3 = str_get_html($data);

                        foreach ($doc3->find('div.itemAnaNews') as $text)
                        {
                            $document = array();
                            $document['title'] = trim(str_replace('&nbsp;', '', $text->find('div.catItemIntroTextdoc', 0)->plaintext));
                            if ($document['title'] == '') {
                                continue;
                            }
                            $tmp = explode(" ", trim(str_replace('&nbsp;', '', $text->find('div.catItemHeader h3', 0)->plaintext)));
                            $document['kind'] = $tmp[0];
                            $document['number'] = array_pop($tmp);
                            $document['published_on'] = str_replace('г.', '', $tmp[sizeof($tmp)-2]);
                            $document['approved_on'] = $document['published_on'];
                            $data = $this->getData($this->url.$text->find('div.catItemHeader h3 a', 0)->href, false);
                            $doc2 = str_get_html($data);
                            $document['attachment_url'] = $this->url.$doc2->find('a.wf_file', 0)->href;
                            if ($document['attachment_url'] == $this->url || preg_match('/силу/i', $document['number'])) continue;
                            $this->saveDocs($document);
                        }
                    }
                }
            } else {
                // конец проверки на подкатегории

                // проверка на пейджинг
                $pageArr = array();
                $pageArr[] = $element->href;

                if ($doc->find('span.pagination', 0)) { // если есть пейджинг
                    foreach ($doc->find('span.pagination a') as $p) {
                        if (!in_array($p->href, $pageArr)) {
                            $pageArr[] = $p->href;
                        }
                    }
                    foreach ($pageArr as $page) {
                        $data = $this->getData($this->url . $page, false);
                        $doc2 = str_get_html($data);

                        foreach ($doc2->find('div.itemAnaNews') as $text) {
                            $document = array();
                            $document['title'] = trim(str_replace('&nbsp;', '', $text->find('div.catItemIntroTextdoc', 0)->plaintext));
                            if ($document['title'] == '') {
                                continue;
                            }
                            $tmp = explode(" ", trim(str_replace('&nbsp;', '', $text->find('div.catItemHeader h3', 0)->plaintext)));
                            $document['kind'] = $tmp[0];
                            $document['number'] = array_pop($tmp);
                            $document['published_on'] = str_replace('г.', '', $tmp[sizeof($tmp) - 2]);
                            $document['approved_on'] = $document['published_on'];
                            $data = $this->getData($this->url . $text->find('div.catItemHeader h3 a', 0)->href, false);
                            $doc3 = str_get_html($data);
                            $document['attachment_url'] = $this->url . $doc3->find('a.wf_file', 0)->href;
                            if ($document['attachment_url'] == $this->url || preg_match('/силу/i', $document['number'])) continue;
                            $this->saveDocs($document);
                        }
                    }
                }
                // конец проверки на пейджинг
            }
        }
    }

    public function actionOhrana()
    {
        $this->executive_id = 32;
        $this->portal_id = 263;
        $pages = 17;

        // сохраняем документы для департамента природных ресурсов и охраны окружающей среды
        if (!file_exists(Yii::app()->basePath . "/../public/uploads/".$this->portal_id)) {
            mkdir(Yii::app()->basePath . "/../public/uploads/".$this->portal_id);
        }

        Yii::import('ext.simple_html_dom');
        $simpleHTML = new simple_html_dom;

        $this->url = 'http://green.tsu.ru';

        for ($i = 1; $i <= $pages; $i++)
        {
            $data = $this->getData($this->url.'/dep/docs/?p='.$i, false);
            $doc = str_get_html($data);

            foreach ($doc->find('table td a') as $element)
            {
                $document['title'] = $element->plaintext;
                $document['kind'] = 'Распоряжение';
                $document['number'] = '';
                $tmp = explode(' ', str_replace(array('&nbsp;', ','), array(' ',''), $doc->find('table td', 0)->plaintext));
                $tmp[1] = $this->_getNumMonthByName($tmp[1]);
                unset($tmp[3]);
                $document['published_on'] = implode('.', $tmp);
                $document['approved_on'] = $document['published_on'];
                $document['attachment_url'] = !preg_match('/http:/i', $element->href) ? $this->url.$element->href : '';
                if ($document['attachment_url'] == '') continue;
                if ($i == 2) {
                    $this->saveDocsNpa($document);
                } else $this->saveDocs($document);
            }
        }

    }

    public function actionTarif()
    {
        $this->executive_id = 27;
        $this->portal_id = 296;
        $pages = 233;

        // сохраняем документы для департамента тарифного регулирования
        if (!file_exists(Yii::app()->basePath . "/../public/uploads/".$this->portal_id)) {
            mkdir(Yii::app()->basePath . "/../public/uploads/".$this->portal_id);
        }

        Yii::import('ext.simple_html_dom');
        $simpleHTML = new simple_html_dom;

        $this->url = 'http://rec.tomsk.gov.ru';

        for ($i = 1; $i <= $pages; $i++)
        {
            $data = $this->getData($this->url.'/document/arhiv/p'.$i.'.html', false);
            $doc = str_get_html($data);

            foreach ($doc->find('div.title2 a') as $element)
            {
                echo $element->href."\n";
                $data = $this->getData($this->url.$element->href, false);
                $doc = str_get_html($data);
                $document['published_on'] = $doc->find(".date", 0)->plaintext;
                $document['approved_on'] = $document['published_on'];
                $tmp = array_values(array_filter(explode(' ', trim($doc->find('.title', 0)->plaintext))));
                $document['kind'] = mb_strtoupper(mb_substr($tmp[1], 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($tmp[1], 1, mb_strlen($tmp[1]), 'UTF-8');
                $document['number'] =  str_replace('№–', '', $tmp[2]);
                unset($tmp[0]);
                unset($tmp[1]);
                unset($tmp[2]);
                $document['title'] = str_replace('"', '', implode(' ', $tmp));
                $document['attachment_url'] = $this->url.'/'.str_replace("../", '', $doc->find(".anonse a", 0)->href);
                if ($document['attachment_url'] == $this->url.'/') continue;
                $this->saveDocs($document);
            }
        }
    }

    public function actionVeteran()
    {
        $this->executive_id = 51;
        $this->portal_id = 280;
        $pages = 1;

        // сохраняем документы для департамента тарифного регулирования
        if (!file_exists(Yii::app()->basePath . "/../public/uploads/".$this->portal_id)) {
            mkdir(Yii::app()->basePath . "/../public/uploads/".$this->portal_id);
        }

        Yii::import('ext.simple_html_dom');
        $simpleHTML = new simple_html_dom;

        $this->url = 'http://gosvet.tomsk.ru';
        for ($i = 1; $i <= $pages; $i++)
        {
            $data = $this->getData($this->url.'/ru/dokumenty/normativno-pravovye-akty?parts_params[documents][page]='.$i, false);
            $doc = str_get_html($data);

            foreach ($doc->find("ul.documents a.pdf") as $element)
            {
                $data = $this->getData($this->url.$element->href, false);
                echo $this->url.$element->href."\n";
                $doc = str_get_html($data);
                $document['title'] = trim($doc->find("h1", 0)->plaintext);
                $document['attachment_url'] = $doc->find("a.pdf", 0)->href;
                $tmp = str_replace('Управление ветеринарии Томской области, ', '', trim($doc->find(".article p", 1)->plaintext));
                $tmp = explode(" ", $tmp);
                $document['kind'] = mb_strtoupper(mb_substr($tmp[0], 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($tmp[0], 1, mb_strlen($tmp[0]), 'UTF-8');
                $document['number'] =  str_replace('№', '', $tmp[1]);

                $document['published_on'] = str_replace('Утверждён:', '', trim($doc->find(".article p", 2)->plaintext));
                $document['approved_on'] = $document['published_on'];
                $this->saveDocs($document);
            }
        }
    }

    public function actionKontrol()
    {
        $this->executive_id = 47;
        $this->portal_id = 276;
        $pages = array(3, 18, 1, 2, 83 => 2, 46 => 6, 74 => 9, 81 => 3, 76 => 3, 11 => 9, 54 => 4, 85, 80 => 2, 84 => 4, 47 => 8, 77 => 9, 82 => 3, 78, 10 => 5, 55 => 2, 86, 79 => 2);

        // сохраняем документы для департамента тарифного регулирования
        if (!file_exists(Yii::app()->basePath . "/../public/uploads/" . $this->portal_id)) {
            mkdir(Yii::app()->basePath . "/../public/uploads/" . $this->portal_id);
        }

        Yii::import('ext.simple_html_dom');
        $simpleHTML = new simple_html_dom;

        $this->url = 'http://knlo.tomsk.gov.ru/modules.php?name=Downloads';

        foreach ($pages as $k=>$page)
        {
            $pagesArr = array();

            if ($k == 0) { // нет пейджинга
                $pagesArr[] = $this->url.'&d_op=viewdownload&cid='.$page;
            } else {
                for ($i = 1; $i <= $page; $i++)
                {
                    $pagesArr[] = $this->url.'&d_op=viewdownload&cid='.$k.'&min='.(($i-1)*10).'&orderby=titleA&show=10';
                }
            }

            foreach ($pagesArr as $p)
            {
                $data = $this->getData($p, false);
                $doc = str_get_html($data);
                $count = 0;

                $tmp = explode('Добавлен:', $doc->find("table font.content", 3)->plaintext);
                $tmp2 = array();
                foreach ($tmp as $k=>$v)
                {
                    if (preg_match('/(\d){2}\/(\d){2}\/(\d){4}/', trim($v))) {
                        $tmp2[] = str_replace('/', '.', substr(trim($v), 0, 10));
                    }
                }

                foreach ($doc->find("img[src='modules/Downloads/images/lwin.gif'] ~ a") as $element)
                {
                    if (preg_match('/modules.php\?name\=Downloads&amp;d_op=getit&amp;lid=/i', $element->href)) {
                        $url = 'http://knlo.tomsk.gov.ru/'.str_replace('&amp;', '&', $element->href);
                        $document['title'] = iconv('WINDOWS-1251', 'UTF-8', $element->innertext);

                        $document['published_on'] = $tmp2[$count];
                        $document['approved_on'] = $document['published_on'];
                        $count++;

                        if( $curl = curl_init() ) {
                            curl_setopt($curl,CURLOPT_URL, $url);
                            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                            curl_setopt($curl,CURLOPT_NOBODY,true);
                            curl_setopt($curl,CURLOPT_HEADER,true);
                            $data = curl_exec($curl);

                            curl_close($curl);
                        }
                        $tmp = explode("\n", $data);
                        foreach ($tmp as $t)
                        {
                            if (preg_match('/Location:/', $t)) {
                                $document['attachment_url'] = trim(substr($t, 9));
                            }
                        }
                        $document['kind'] = 'Распоряжение';
                        $this->saveDocs($document);
                    }
                }
            }
        }
    }

    public function actionSubportals()
    {
        foreach (Portal::model()->findAll() as $p) {
            echo "{$p->alias}\n";

        }
    }

    protected function getData($url, $isJson = true)
    {
        $content = @file_get_contents($url);

        if ($isJson) {
            return json_decode($content, true);
        } else {
            return $content;
        }
    }

    protected function saveDocs($document)
    {
        $foldersGroup = FoldersGroup::model()->findByAttributes(array('alias' => 'main', 'portal_id' => $this->portal_id));
        $folder = modelFactory::get('DocumentsFolder', array('title' => $document['kind']));

        if ($folder->isNewRecord) {
            $folder->group_id = $foldersGroup->id;
            $folder->state = 1;
            $folder->save();
        }

        $file = new File();

        // возможно самый гемор, получаем и записывыем файл
        $content = $this->getData($document['attachment_url'], false);
        $tmp = explode('.', $document['attachment_url']);
        $ext = strtolower(end($tmp));
        $fileName = sha1(uniqid()) . '.' . $ext;

        $tmp = explode('/', $document['attachment_url']);
        $originName = end($tmp);

        $fp = fopen(Yii::app()->basePath . "/../public/uploads/{$this->portal_id}/" . $fileName, 'w+');

        if (fwrite($fp, $content) === false) {
            echo "\nCant save file to path: " . Yii::app()->basePath . "/../public/uploads/{$this->portal_id}/" . $fileName;
            return;
        }
        $file->attributes = array(
            'portal_id' => $this->portal_id,
            'origin_name' => $originName,
            'name' => $fileName,
            'size' => filesize(Yii::app()->basePath . "/../public/uploads/{$this->portal_id}/" . $fileName),
            'ext' => $ext,
            'date' => strtotime($document['published_on'])
        );

        if (!$file->save()) {
            echo "Cant save file error is: " . print_r($file->getErrors(), 1);
        }

        $docModel = new Documents();
        $docModel->attributes = array(
            'folder_id' => $folder->id,
            'title' => $document['title'],
            'date_public' => strtotime($document['published_on']),
            'date_real' => strtotime($document['approved_on']),
            'public' => 1,
            'number' => $document['number'],
            'executive_id' => $this->executive_id
        );

        if (isset($document['note'])) {
            $docModel->attributes['note'] = $document['note'];
        }

        switch ($file->ext) {
            case 'pdf':
                $docModel->pdf = $file->id;
                break;

            case 'docx':
            case 'doc':
                $docModel->doc = $file->id;
                break;

            case 'zip':
                $docModel->zip = $file->id;
                break;

            default:
                echo "File extension is {$file->ext}\n";
                continue;
                break;
        }

        try {
            if (!$docModel->save())
                echo "Cant save doc model " . print_r($docModel->getErrors(), 1);
        } catch (Exception $e) {
            print_r($e);
        }
        return;
    }

    public function saveDocsNpa($document)
    {
        $file = $this->makeFileRecord($document);

        if ($file === false) {
            echo "Something wring with file record! Data not saved\n";
            return;
        }

        $docModel = new Npa();
        $docModel->attributes = array(
            'portal_id' => $this->portal_id,
            'title' => $document['title'],
            'type' => $document['kind'],
            'date_publish' => strtotime($document['published_on']),
            'file' => $file->id,
            'executive_id' => $this->executive_id
        );

        if (!$docModel->save())
            echo "Cant save doc model " . print_r($docModel->getErrors(), 1);
    }

    private function _getNumMonthByName($name)
    {
        $months = array(
            'Января' => '01',
            'Февраля' => '02',
            'Марта' => '03',
            'Апреля' => '04',
            'Мая' => '05',
            'Июня' => '06',
            'Июля' => '07',
            'Августа' => '08',
            'Сентября' => '09',
            'Октября' => '10',
            'Ноября' => '11',
            'Декабря' => '12'
        );
        return isset($months[$name]) ? $months[$name] : '01';
    }
}