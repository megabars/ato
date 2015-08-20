<?php

class FrontController extends Controller
{
    protected $delimiter = ',';

    public function init()
    {
        parent::init();

        $this->navigationItemId = 1600;

        $this->registerModuleAssetsScripts(array('script.js'), array());
    }

    public function actions()
    {
        return array(
            'captcha' => array(
                'class'     => 'CCaptchaAction',
                'backColor' => 0xe8e8e8,
                'foreColor' => 0x2d8d38,
                'testLimit' => 2,
            ),
        );
    }

    public function actionIndex($title = null, $category = 'all', $portal_id = 'all')
    {
        $criteria = new CDbCriteria();

        if ($title)
            $criteria->addSearchCondition("title", $title, true, 'AND', 'ILIKE');

        // Если не указана ни одна категория или ни один портал количество записей возвращем 0
        if (!$category || !$portal_id)
        {
            if ($category && $category != 'all')
            {
                $category = explode(',', $category);
            }

            if ($portal_id && $portal_id != 'all')
            {
                $portal_id = explode(',', $portal_id);
            }

            $criteria->addCondition("category = '-1'");
        }
        else
        {
            if ($category && $category != 'all')
            {
                $category = explode(',', $category);
                $criteria->distinct = true;
                $criteria->join = 'INNER JOIN opendata_categories ON opendata_categories.opendata_id = t.id';
                $criteria->addInCondition('opendata_categories.category_id', $category);
            }

            if ($portal_id && $portal_id != 'all')
            {
                $portal_id = explode(',', $portal_id);
                $criteria->addInCondition('portal_id', $portal_id);
            }
        }

        $count = Opendata::model()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $this->render('index', array(
            'records' => Opendata::model()->findAll($criteria),
            'pages' => $pages,
            'portals' => Portal::model()->hasOpendata()->findAll(array('order' => 'title ASC')),
            'count' => $count,
            'all_item_count' => Opendata::model()->count(),
            'title' => $title,
            'category' => $category,
            'portal_id' => $portal_id,
        ));
    }

    public function actionView($id)
    {
        if (!$record = Opendata::model()->findByPk($id))
            $this->errorTo('/opendata/front/index', 'Запись не найдена');

        $record->view_count++;
        $record->save();

        $this->render('view', array(
            'record' => $record,
            'portal' => Portal::model()->findByPk($record->portal_id),
        ));
    }

    public function actionStatistic()
    {
        $this->render('statistic', array(

        ));
    }

    public function actionForm()
    {
        $model = new OpendataForm();

        if (isset($_POST['OpendataForm']))
        {
            $model->attributes = $_POST['OpendataForm'];

            if ($model->validate())
            {
                $text = "ФИО: {$model->fio}<br/><br/>Email: {$model->email}<br/><br/>Текст сообщения: {$model->text}";

                $mail = new Mail();
                $mail->mail->addAddress('magarramovada@tomsk.gov.ru');

                if($mail->send('deprio@tomsk.gov.ru', $model->subject, $text))
                {
                    $this->noticeTo($this->createUrl('/opendata/front/form'), 'Сообщение успешно отправлено');
                }
                else
                {
                    $this->errorTo($this->createUrl('/opendata/front/form'), 'Ваше сообщение небыло отправлено! Сервер не отвечает');
                }
            }
        }

        $this->render('form', array(
            'model' => $model,
        ));
    }

    /**
     * Формирование файла паспорта в формате CSV
     * @param $id
     */
    public function actionGetPassport($id)
    {
        if (!$record = Opendata::model()->findByPk($id))
            $this->errorTo('/', 'Не удалось найти набор открытых данных');

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Type: text/csv;');
        header('Content-Disposition: attachment; filename="meta.csv"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $file = fopen('php://output', 'w');

        // Формируем некоторые элементы вручную
        $versionString = '';
        foreach ($record->versions as $version)
            $versionString .= $this->createUrl('/opendata/front/getVersion', array('id' => $record->id, 'version' => $version->id)) . "\r\n";

        $record->format = 'CSV';
        $record->link = $this->createAbsoluteUrl('/opendata/front/getVersion', array('id' => $record->id));
        $record->structure = $this->createAbsoluteUrl('/') . File::model()->getFileUrl($record->structure_file);
        $record->link_version = $versionString;

        // Записываем построчно определенные атрибуты модели Opendata в csv файл
        foreach ($record->getAttributes() as $attrName => $attrValue)
        {
            if (in_array($attrName, array('identifier', 'title', 'description', 'owner', 'responsible', 'phone', 'email',
                'link', 'format', 'structure', 'date_init', 'date_last_change', 'last_content', 'date_actual',
                'link_version', 'keyword', 'version')))
            {
                fputcsv($file, array($record->getAttributeLabel($attrName), $attrValue), $this->delimiter);
            }
        }

        fclose($file);
        exit;
    }

    /**
     * Получение реестра наборов данных
     */
    public function actionGetAllOpendata()
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Type: text/csv;');
        header('Content-Disposition: attachment; filename="list.csv"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $file = fopen('php://output', 'w');

        fputcsv($file, array('property', 'title', 'value', 'format'), $this->delimiter);
        fputcsv($file, array('standardversion', 'Версия методических рекомендаций', $this->createAbsoluteUrl('/uploads/opendata_metodic.pdf'), ''), $this->delimiter);

        foreach (Opendata::model()->findAll() as $opendata)
        {
            fputcsv($file, array($opendata->identifier, $opendata->title, $this->createAbsoluteUrl('/opendata/front/getVersion', array('id' => $opendata->id)), 'csv'), $this->delimiter);
        }

        fclose($file);
        exit;
    }

    /**
     * Получение файла открытых данных по id и версии
     * @param $id
     * @param null $version
     */
    public function actionGetVersion($id, $version = null)
    {
        if (!$record = Opendata::model()->findByPk($id))
            $this->errorTo('/', 'Не удалось найти набор открытых данных');

        $record->download_count++;
        $record->save();

        if ($version)
        {
            foreach ($record->versions as $item)
            {
                if ($item->id == $version)
                    $this->redirect(File::model()->getFileUrl($item->file));
            }
        }
        // Отдаем файл последней версии набора
        else
            $this->redirect(File::model()->getFileUrl($record->getLatestVersionFile()));
    }

    /**
     * Получение файла структуры версии открытых данных
     * @param $id
     * @param $version
     */
    public function actionGetStructure($id, $version)
    {
        if (!$record = Opendata::model()->findByPk($id))
            $this->errorTo('/', 'Не удалось найти набор открытых данных');

        foreach ($record->versions as $item)
        {
            if ($item->id == $version)
            {
                if (($file = File::model()->getFileUrl($item->structure_file)) && $file != '/')
                    $this->redirect($file);
            }
        }

        $this->errorTo($this->createUrl('/opendata/front/view', array('id' => $id)), 'Не удалось найти файл');
    }

    /**
     * Получение набора открытых данных в виде XML
     * @param $id
     */
    public function actionGetXML($id)
    {
        if (!$opendata = Opendata::model()->findByPk($id))
            $this->errorTo('/', 'Не удалось найти набор открытых данных');

        if (!is_file(File::model()->getFilePath($opendata->getLatestVersionFile())))
            $this->errorTo($this->createUrl('/opendata/front/view', array('id' => $id)), 'Неправильный формат открытых данных');

        $opendata->download_count++;
        $opendata->save();

        list($names, $fileData) = $this->parseData($opendata);

        $content = $this->getXMLFromData($opendata, $fileData);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $opendata->title . '.xml"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . mb_strlen($content));

        echo $content;
        exit;
    }

    /**
     * Страница представления данных в табличном виде (HTML)
     * @param $id
     */
    public function actionGetTable($id)
    {
        if (!$opendata = Opendata::model()->findByPk($id))
            $this->errorTo('/opendata/front/index', 'Не удалось найти набор открытых данных');

        if (!is_file(File::model()->getFilePath($opendata->getLatestVersionFile())))
            $this->errorTo($this->createUrl('/opendata/front/view', array('id' => $id)), 'Неправильный формат открытых данных');

        list($names, $fileData) = $this->parseData($opendata);

        $this->render('table', array(
            'record' => $opendata,
            'names' => $names,
            'fileData' => $fileData,
        ));
    }

    /**
     * Страница описания api для набора данных
     * @param $id
     */
    public function actionGetApi($id)
    {
        if (!$opendata = Opendata::model()->findByPk($id))
            $this->errorTo('/opendata/front/index', 'Не удалось найти набор открытых данных');

        if (!is_file(File::model()->getFilePath($opendata->getLatestVersionFile())))
            $this->errorTo($this->createUrl('/opendata/front/view', array('id' => $id)), 'Неправильный формат открытых данных');

        list($names, $fileData) = $this->parseData($opendata);

        $this->render('api', array(
            'record' => $opendata,
            'names' => $names,
            'fileData' => $fileData,
        ));
    }

    /**
     * Получение набора данных, API
     * @param $id
     * @param $type
     * @param $fields
     * @param $sortby
     */
    public function actionData($id, $type = 'json', $fields = null, $sortby = null)
    {
        if ($opendata = Opendata::model()->findByPk($id))
        {
            list($names, $fileData) = $this->parseData($opendata, $fields);

            // Сортируем по определенному полю массива
            if ($sortby && in_array($sortby, $names))
            {
                uasort($fileData, function($first, $second) use ($sortby) {
                    return (@$first[$sortby] < @$second[$sortby]) ? -1 : 1;
                });
            }

            if ($type == 'json')
                echo json_encode($fileData);
            else
            {
                header('Content-Type: text/xml');
                echo $this->getXMLFromData($opendata, $fileData);
            }
        }
        else
        {
            if ($type == 'json')
                echo json_encode(array());
            else
                echo '';
        }
    }

    /**
     * Функция получения списка имен столбцов, и данных из csv
     * @param $opendata
     * @param $fields
     * @return array
     */
    public function parseData($opendata, $fields = null)
    {
        $file = fopen(File::model()->getFilePath($opendata->getLatestVersionFile()), "r");

        $fileData = array();

        $nameList = array();

        // Получаем список названий колонок
        if ($names = fgetcsv($file, 2000000, ',', '"'))
        {
            // Убираем все ненужные символы
            foreach ($names as $index => $item)
            {
                if ($item)
                {
                    $nameList[$index] = str_replace('"', '', $item);
                }
            }

            // Если указаны определенные поля, проверяем, действительно ли такие есть. И если есть, оставляем только их
            if ($fields)
                $fields = array_intersect(explode(',', $fields), $names);

            while ($data = fgetcsv($file, 2000000, ',', '"'))
            {
                $itemData = array();

                foreach ($data as $index => $item)
                {
                    $fieldName = @$nameList[$index];

                    // Если $fields равно null или поле присутсвует в списке выбираемых полей, достаем информацию по нему
                    if (!$fields || in_array($fieldName, $fields))
                        $itemData[$fieldName] = $item;
                }

                $fileData[] = $itemData;
            }
        }

        fclose($file);

        return array($nameList, $fileData);
    }

    /**
     * Формирование XML
     * @param $opendata
     * @param $fileData
     * @return string
     */
    public function getXMLFromData($opendata, $fileData)
    {
        $dom = new domDocument("1.0", "utf-8");

        $title = str_replace(' ', '_', $opendata->title);

        // Почему-то неправильно декодирует
        mb_internal_encoding('UTF-8');
        mb_regex_encoding('UTF-8');
        $title = mb_ereg_replace('[().,﻿]', '', $title, 'i');

        $root = $dom->createElement($title);

        foreach ($fileData as $rowIndex => $items)
        {
            $row = $dom->createElement("строка_" . ($rowIndex + 1));

            foreach ($items as $key => $value)
            {
                $key = str_replace(' ', '_', $key);
                $key = mb_ereg_replace('[().,﻿]', '', $key, 'i');

                try
                {
                    $element = $dom->createElement($key, $value);
                }
                catch(Exception $e)
                {
                    $element = $dom->createElement('error_column_name', $value);
                }

                $row->appendChild($element);
            }

            $root->appendChild($row);
        }

        $dom->appendChild($root);

        return $dom->saveXML();
    }
}