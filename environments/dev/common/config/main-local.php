<?php
$arg = [
    'password' => '',
    'domain' => YII_ENV === 'prod' ? 'drodata.com' : 'dro.com',
    'dbname' => 'drodata_com',
];
return [
    'aliases' => [
        '@epweb'  => 'http://ep.' . $arg['domain'],
        '@iepweb'  => 'http://i.ep.' . $arg['domain'],
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=' . $arg['dbname'],
            'username' => 'root',
            'password' => $arg['password'],
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityCookie' => [
                'name' => '_identity',
                'domain'   => '.' .$arg['domain'],
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'cookieParams' => [
                'domain'   => '.' .$arg['domain'],
                'httpOnly' => true,
            ],
        ],
    ],
];
