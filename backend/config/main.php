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
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'dashboard/index',
    'bootstrap' => ['log'],
    'modules' => [
        'notification' => [
            'class' => 'dro\notification\Module',
        ],
    ],
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
                'demo/ajax-get-select-modal' => 'demo/ajax-get-select-modal',
                'demo/<category>' => 'demo/index',
            ],
        ],
    ],
    'params' => $params,
];
