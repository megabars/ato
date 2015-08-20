<?php

class SocialImportCommand extends CConsoleCommand
{
    public $portalId = 279;

    public $executiveId = 31;

    public function actionIndex()
    {
        Yii::import('ext.simple_html_dom');

        $simpleHTML = new simple_html_dom();

        $links = array(
            'http://dep.agro.tomsk.ru/regulatory/?PAGEN_1=1' => 'Акт',
            'http://dep.agro.tomsk.ru/regulatory/?PAGEN_1=2' => 'Акт',
            'http://dep.agro.tomsk.ru/regulatory/?PAGEN_1=3' => 'Акт',
            'http://dep.agro.tomsk.ru/regulatory/?PAGEN_1=4' => 'Акт',
            'http://dep.agro.tomsk.ru/regulatory/?PAGEN_1=5' => 'Акт',
            'http://dep.agro.tomsk.ru/regulatory/?PAGEN_1=6' => 'Акт',
            'http://dep.agro.tomsk.ru/regulatory/?PAGEN_1=7' => 'Акт',
        );

        foreach ($links as $url => $type)
        {
            $html = str_get_html(file_get_contents($url));

            foreach ($html->find('.news-item') as $item)
            {
                $title = '';

                foreach ($item->find('b') as $b)
                    $title = trim(strip_tags(str_replace('&nbsp;', '', $b)));

                foreach ($item->find('small a') as $a)
                {
                    if ($fileId = $this->makeFileFromUrl($a->href))
                    {
                        $model = new Npa();

                        $model->attributes = array(
                            'portal_id' => $this->portalId,
                            'title' => $title,
                            'type' => $type,
                            'date_publish' => time(),
                            'file' => $fileId,
                            'executive_id' => $this->executiveId,
                        );

                        $model->save();
                    }
                    else
                        echo 'Не удалось сохранить файл: ' . $a->href;
                }
            }
        }
    }

    public function makeFileFromUrl($url)
    {
        $url = urldecode($url);

        $url = mb_substr($url, mb_strpos($url, 'goto=') + 5);

        if (!$content = Yii::app()->curl->get('http://dep.agro.tomsk.ru' . $url))
            return null;

        $realfileName = mb_substr($url, strripos ($url, '/') + 1);

        $tmp = explode('.', $realfileName);
        $ext = strtolower(end($tmp));
        $fileName = sha1(uniqid()) . '.' . $ext;
        $fullFilePath = Yii::app()->basePath . '/../public/uploads/' . $this->portalId . '/' . $fileName;

        $fp = fopen($fullFilePath, 'w+');

        if (fwrite($fp, $content) === false)
            return null;

        fclose($fp);

        $file = new File();

        $file->attributes = array(
            'portal_id' => $this->portalId,
            'origin_name' => $realfileName,
            'name' => $fileName,
            'size' => filesize($fullFilePath),
            'ext' => $ext,
            'date' => time(),
        );

        if ($file->save())
            return $file->id;

        return null;
    }
}