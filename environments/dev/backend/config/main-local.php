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
    $config['aliases']['@ut'] = 'path-to-local-yii2-utility';

    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',      
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],  
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'drodata' => '@drodata/gii-templates/backend/crud/default',
                    'drodata-local' => '@ut/gii-templates/backend/crud/default',
                ]
            ],
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => [
                    'drodata' => '@drodata/gii-templates/backend/model/default',
                    'drodata-local' => '@ut/gii-templates/backend/model/default',
                ]
            ],
            'controller' => [
                'class' => 'yii\gii\generators\controller\Generator',
                'templates' => [
                    'drodata' => '@drodata/gii-templates/backend/controller/default',
                    'drodata-local' => '@ut/gii-templates/backend/controller/default',
                ]
            ],
            'form' => [
                'class' => 'yii\gii\generators\form\Generator',
                'templates' => [
                    'drodata' => '@drodata/gii-templates/backend/form/default',
                    'drodata-local' => '@ut/gii-templates/backend/form/default',
                ]
            ],
        ],
    ];
}

return $config;
