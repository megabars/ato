<?php

class LeshozImportCommand extends CConsoleCommand
{
    public $portalId = 254;

    public $executiveId = 61;

    public function actionIndex()
    {
        Yii::import('ext.simple_html_dom');

        $simpleHTML = new simple_html_dom();

        $links = array(
            'http://www.tomskles.ru/Dokumenty/Regionalnye_normativnye_pravovye/Prikazy_departamenta/' => 'Приказ',
            'http://www.tomskles.ru/Dokumenty/Regionalnye_normativnye_pravovye/Postanovleniya_i_rasporyazheniya/' => 'Постановление',
            'http://www.tomskles.ru/Dokumenty/Federalnye_normativnye_pravovye/' => 'Акт',
        );

        foreach ($links as $url => $type)
        {
            $html = str_get_html(file_get_contents($url));

            foreach ($html->find('.text-link') as $item)
            {
                if ($fileId = $this->makeFileFromUrl($item->href))
                {
                    $model = new Npa();

                    $model->attributes = array(
                        'portal_id' => $this->portalId,
                        'title' => trim(strip_tags(str_replace('&nbsp;', '', $item->plaintext))),
                        'type' => $type,
                        'date_publish' => time(),
                        'file' => $fileId,
                        'executive_id' => $this->executiveId,
                    );

                    $model->save();
                }
                else
                    echo 'Не удалось сохранить файл: ' . $item->href;
            }
        }
    }

    public function makeFileFromUrl($url)
    {
        if (!$content = Yii::app()->curl->get('http://www.tomskles.ru' . $url))
            return null;

        $realfileName = mb_substr($url, mb_strpos($url, 'file=') + 5);

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