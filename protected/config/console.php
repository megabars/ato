<?php

date_default_timezone_set('Europe/Moscow');
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$mailConfig = include('main.php');

return array_merge(array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => $mailConfig['name'],
        'import' => $mailConfig['import'],
        'modules' => $mailConfig['modules'],
        'components' => $mailConfig['components'],
    ));