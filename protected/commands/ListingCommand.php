<?php
/**
 * author: Mikhail Matveev
 * Date: 23.12.14 
 */

class ListingCommand extends CConsoleCommand {

    function actionIndex()
    {
//        $dir = Yii::app()->basePath;
//
//        $this->getData($dir);
//        print_r($this->getData($dir));

        $client = new SoapClient('https://xn--d1aup.xn--33-6kcadhwnl3cfdx.xn--p1ai/ws/dou_spyne?wsdl', array(
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => true
        ));

        $data = $client->__soapCall('getDistrictList', array('kind' => 5));

        print_r($data);



    }

    public function getData($dir) {
        // array to hold return value
        $retval = array();

        // add trailing slash if missing
        if(substr($dir, -1) != "/") $dir .= "/";

        // open pointer to directory and read list of files
        $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
        while(false !== ($entry = $d->read())) {
            // skip hidden files
            if($entry[0] == ".") continue;
            if(!is_dir("$dir$entry")) {
                $name = "$dir$entry";

                $parts = explode('.', $name);

                if (end($parts) == 'php') {
                    echo "Filename: $name";
                    echo file_get_contents($name);

                $retval[] = array(
                    "name" => $name,
                    "type" => filetype("$dir$entry"),
                    "size" => 0,
                    "lastmod" => filemtime("$dir$entry")
                );
                }
            } else {
                $retval = array_merge($retval, $this->getData("$dir$entry"));
            }
//            elseif(is_readable("$dir$entry")) {
//                $retval[] = array(
//                    "name" => "$dir$entry",
//                    "type" => mime_content_type("$dir$entry"),
//                    "size" => filesize("$dir$entry"),
//                    "lastmod" => filemtime("$dir$entry")
//                );
//            }
        }
        $d->close();

        return $retval;
    }

}