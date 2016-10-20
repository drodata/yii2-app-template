<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'YAT',
    'timeZone' => 'Asia/Shanghai', // timezone list: http://php.net/manual/en/timezones.php
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'dashboard/index',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['info'],
                    'categories' => ['b.*'],
                    'logVars' => [], // disable append context message
                    'prefix' => function() {
                            return Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username;
                        },
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'rules' => [
                'demo/<category>' => 'demo/index',
            ],
        ],
    ],
    'params' => $params,
];
