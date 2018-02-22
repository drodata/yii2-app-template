<?php
$sensitive = json_decode(file_get_contents(Yii::getAlias('@common') . '/yii2-sensitive.json'));
$arg = [
    'domain' => 'yat.com',
];
return [
    'aliases' => [
        '@frontendweb'  => 'http://www.' . $arg['domain'],
        '@backendweb'  => 'http://backend.' . $arg['domain'],
        '@mobileweb'  => 'http://m.' . $arg['domain'],
        '@staticweb'  => 'http://static.' . $arg['domain'],
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => "mysql:host=localhost;dbname={$sensitive->dbname}",
            'username' => 'root',
            'password' => $sensitive->password,
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
