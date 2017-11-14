<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

/**
 * Customize core classmap. The `@ut` aliases was defined in
 * common/config/main-local.php
 */
// Yii::$classMap['drodata\adminlte\Tabs'] = '@ut/adminlte/Tabs.php';
//Yii::$classMap['drodata\gii\backend\crud\Generator'] = '@ut/gii/backend/crud/Generator.php';

$application = new yii\web\Application($config);
$application->run();
