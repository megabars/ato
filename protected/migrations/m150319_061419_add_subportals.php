<?php

class m150319_061419_add_subportals extends CDbMigration
{
    const SUFFIX_DOMAIN = '.tomsk.dpridprod.ru';
    public function up()
    {
        // автолоад нихрена не срабатывает, некогда разбираться, такой костыль:
        include_once(Yii::app()->getBasePath().'/modules/files/models/File.php');
        $path = Yii::app()->getBasePath() . '/data/list_subportals_iogv.csv';
        if (file_exists($path)) 
        {  	   
            $fp = fopen($path, 'r');
            $data = array();
            while (($filePart = fgetcsv($fp, 0, ';')) !== false)
                $data[] = $filePart;
            fclose($fp);
            array_shift($data);	    
            // распарсился? структура верная?
            if ($data === false OR count($data[0]) < 2) 
            {	
                echo 'Format file is not valid';
                return false;
            } 
            else 
            {		
                foreach ($data as $num => $item) 
                {		    
                    list($title, $alias) = $item;		    
                    $portal = new Portal(); 	     	    
                    $portal->theme = 'iogv';		   
                    $portal->title = $title;		 
                    $portal->alias = $alias . self::SUFFIX_DOMAIN;
		    echo "Saving $num/".count($data)."\n";
                    if (!$portal->save())
                    {			
                        echo 'Not valid csv-file: '.$title;
                        var_dump($portal->getErrors());
                        return false;
                    }		  
                }		
                echo 'All good!';
                return true;
            }
        }
        else
            echo 'Not found file';
    }

	public function safeDown()
	{
            return true;
	}

}
