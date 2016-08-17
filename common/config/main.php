<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=drodata_com',
            'username' => 'root',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'enableStrictParsing' => false,
            'rules' => [
            ],
        ],
        'formatter' => [
            'dateFormat' => 'php:Y-m-d',
            'timeFormat' => 'H:i',
            'datetimeFormat' => 'php:Y-m-d H:i',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'defaultTimeZone' => 'Asia/Shanghai',
       ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', 
        ],
    ],
];
