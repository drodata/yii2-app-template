<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'nt',
    'name' => 'New Tier',
    'controllerNamespace' => 'nt\controllers',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'modules' => [
		'gii' => [
			'generators' => [
				'model' => [
					'class' => 'yii\gii\generators\model\Generator',
					'templates' => [
						'drodata' => '@common/templates/gii/model',
					],
				],
				'form' => [
					'class' => 'yii\gii\generators\form\Generator',
					'templates' => [
						'drodata' => '@common/templates/gii/form',
					],
				],
				'crud' => [
					'class' => 'yii\gii\generators\crud\Generator',
					'templates' => [
						'drodata' => '@common/templates/gii/crud',
					],
				],
				'controller' => [
					'class' => 'yii\gii\generators\controller\Generator',
					'templates' => [
						'drodata' => '@common/templates/gii/controller',
					],
				],
			],
		],
	],
    'components' => [
        'db' => [
        ],
        'user' => [
            'identityClass' => 'drodata\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            //'errorAction' => 'site/error',
        ],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
			'rules' => [
			],
        ],
    ],
    'params' => $params,
];
