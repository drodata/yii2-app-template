<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}
if (YII_ENV_DEV) {    
    // to debug the yii2-utility extension locally
    $config['aliases']['@ut'] = '/home/ts/www/yii2-utility'; // Debian
    //$config['aliases']['@ut'] = '/Users/drodata/www/yii2-utility'; // Mac

    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',      
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],  
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'drodata' => '@drodata/gii/backend/crud/default',
                    'drodata-local' => '@ut/gii/backend/crud/default',
                ]
            ],
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => [
                    'drodata' => '@drodata/gii/backend/model/default',
                    'drodata-local' => '@ut/gii/backend/model/default',
                ]
            ],
            'controller' => [
                'class' => 'yii\gii\generators\controller\Generator',
                'templates' => [
                    'drodata' => '@drodata/gii/backend/controller/default',
                    'drodata-local' => '@ut/gii/backend/controller/default',
                    'drodata-local-api' => '@ut/gii/api/controller/default',
                ]
            ],
            /*
            'controller-api' => [
                'class' => 'drodata\gii\api\controller\Generator',
                'templates' => [
                    'default' => '@ut/gii/api/controller/default',
                ]
            ],
            */
            'form' => [
                'class' => 'yii\gii\generators\form\Generator',
                'templates' => [
                    'drodata' => '@drodata/gii/backend/form/default',
                    'drodata-local' => '@ut/gii/backend/form/default',
                ]
            ],
        ],
    ];
}

return $config;
