<?php

class Utils extends CComponent
{
	public static function getReadableFileSize($size = 0, $retstring = null)
	{
		$sizes = array('bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

		if ($retstring === null)
			$retstring = '%01.2f %s';


		$lastsizestring = end($sizes);

		foreach ($sizes as $sizestring) {
			if ($size < 1024)
				break;

			if ($sizestring != $lastsizestring)
				$size /= 1024;
		}

		if ($sizestring == $sizes[0])
			$retstring = '%01d %s';

		return sprintf($retstring, $size, $sizestring);
	}

	public static function toByteSize($p_sFormatted) {
		$aUnits = array('B'=>0,'b'=>0, 'KB'=>1, 'kB'=>1, 'MB'=>2,'M'=>2,'GB'=>3, 'TB'=>4, 'PB'=>5, 'EB'=>6, 'ZB'=>7, 'YB'=>8);
		$sUnit = strtoupper(trim(str_replace((float)$p_sFormatted,'',$p_sFormatted)));
		if (intval($sUnit) !== 0) {
			$sUnit = 'B';
		}
		if (!in_array($sUnit, array_keys($aUnits))) {
			return false;
		}
		$iUnits = trim(substr($p_sFormatted, 0, strlen($p_sFormatted) - strlen($sUnit)));
		if (!intval($iUnits) == $iUnits) {
			return false;
		}
		return $iUnits * pow(1024, $aUnits[$sUnit]);
	}

	/**
	 * Функция склонения числительных в русском языке
	 *
	 * @param int $number Число которое нужно просклонять
	 * @param array $titles Массив слов для склонения
	 * @return string
	 **/

	public static function declOfNum($number, $titles)
	{
		$cases = array(2, 0, 1, 1, 1, 2);
		return $number . " " . $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];

	}

	/**
	 * Функция выплевывания файла на скачивание
	 * @param $file
	 * @param null $name
	 * @throws CHttpException
	 */
	public static function file_force_download($file, $name = null)
	{
		if (file_exists($file)) {
			if (ob_get_level()) {
				ob_end_clean();
			}
			if ($name == null)
				$name = basename($file);
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $name);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			if ($fd = fopen($file, 'rb')) {
				while (!feof($fd)) {
					print fread($fd, 1024);
				}
				fclose($fd);
			}
			exit;
		} else
			throw new CHttpException(404, 'Нет указанного файла');
	}

	public static function getExtensionName($file_name)
	{
		if(($pos=strrpos($file_name,'.'))!==false)
			return (string)substr($file_name,$pos+1);
		else
			return '';
	}

	public static  function getMonth()
	{
		for($x=0; $x<12; $x++)
		{
			$month = mktime(0, 0, 0, date("m")+$x, date("d"),  date("Y"));
			$key = (int)date('m', $month);
			$months[$key] = Rudate::date(date('F', $month));
		}

		ksort($months);
		return $months;
	}

	public static function  ArrayMergeKeepKeys() {
		$arg_list = func_get_args();
		foreach((array)$arg_list as $arg){
			foreach((array)$arg as $k => $v){
				$merge[$k]=$v;
			}
		}
		return $merge;
	}


	public static function replaseOs($str)
	{
		$os = array('ubuntu','centos');
		$min = strlen($str);
		foreach($os as $o)
			if ($pos = strpos($str, $o))
				$min = min($min,$pos);

//		$str = str_replace($os," ",$str);
//		$str = substr($str,0,$min);
		return $str;
	}
}