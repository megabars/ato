<?php

//date_default_timezone_set('Europe/Moscow');
ini_set('error_reporting', E_ALL);
ini_set("display_errors","1");
$yii = dirname(__FILE__) . '/../yii/framework/yii.php';
$config = dirname(__FILE__) . '/../protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once($yii);

Yii::createWebApplication($config)->run();
