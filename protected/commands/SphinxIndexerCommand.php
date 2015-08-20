<?php

require_once __DIR__ . '/../modules/search/models/Sphinx.php';

class SphinxIndexerCommand extends CConsoleCommand
{
    public $pattern = '|<div class="content">(?P<content>.+?)<div class="footer">|isu';

    public function actionIndex()
    {
        $transaction = Yii::app()->db->beginTransaction();

        try
        {
            if ($data = $this->parseLog())
            {
                Sphinx::model()->deleteAll();

                $count = 0;

                echo "Start db inserting\n";

                foreach ($data as $url => $path)
                {
                    $filePath = __DIR__ . "/../modules/search/helpers/index/{$path}";

                    if (is_file($filePath))
                    {
                        $content = file_get_contents($filePath);

                        preg_match_all($this->pattern, $content, $matches);

                        if ($matches['content'])
                            file_put_contents($filePath, $matches['content']);
                    }

                    $model = new Sphinx();
                    $model->url = $url;
                    $model->path = $filePath;

                    if ($model->save())
                        $count++;
                }

                if ($count)
                {
                    echo "{$count} records inserted to db\n";

                    $transaction->commit();
                    Yii::app()->end();
                }
            }

            $transaction->rollback();
        }
        catch (Exception $e)
        {
            $transaction->rollback();

            echo "Error! Can't insert data!\n";
        }
    }

    private function parseLog()
    {
        $file = file_get_contents(__DIR__ . "/../modules/search/helpers/index/index.log");

        preg_match_all('/.*? URL:(.*?) \[.*?\] -> "(.*?)" \[.*?\]/s', $file, $matches);

        if (isset($matches[2]))
        {
            $count = count($matches[2]);

            $result = array();

            for ($i = 0; $i < $count; $i++)
            {
                if (strpos($matches[1][$i], '/files/') === false)
                    $result[$matches[1][$i]] = $matches[2][$i];
            }

            return $result;
        }
        else
        {
            echo "error parsing wget log file\n";

            Yii::app()->end();
        }
    }

    public function actionSockets(){
//        $s = fsockopen("192.168.2.2", 80, $errno, $errstr, 5);
        $s = fsockopen("google.com", 80, $errno, $errstr, 5);
        fwrite($s, "GET /"."\r\n");
        $data = fread($s, 500);
        print_r($data);
        die($errno.", ".$errstr.", ".$s);
//        $client = new sphinxclient();
//        $client->_host = '127.0.0.1';
//		$client->_port = 3312;
//        $client->SetMatchMode(0);
//        $client->SetLimits(($pageNumber - 1) * $per_page, $per_page);
//        $client->SetArrayResult(true);
//        $result = $client->Query('Томск', 'tomsk');
//        print_r($result);



    }
}