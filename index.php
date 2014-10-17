<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/framework/yii.php';
//$yii = dirname(__FILE__) . '/../../yii-1.1.15.022a51/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';
setlocale(LC_ALL, 'fr_FR.utf8', 'fra');

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
error_reporting(-1);
ini_set('display_errors', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
