<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'smileboard',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'sourceLanguage'=>'pt-br',
    'language'=>'pt-br',
    'timeZone' => 'America/Sao_Paulo',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gCQYf1y_KF3U89cnVaosLEm9penetMUF',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Usuarios',
            'enableAutoLogin' => false,
            'loginUrl' => ['usuarios/login'],
            'enableSession' => true
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
              'class' => 'Swift_MailTransport',
              /*'host' => ' br186.hostgator.com.br',
              'username' => ' smileboard@redware.com.br',
              'password' => 'JonSnow',
              'port' => '465',*/
          ],
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
        'db' => require(__DIR__ . '/db.php'),
        'formatter' => [
            'defaultTimeZone' => 'UTC',
            'timeZone' => 'America/Sao_Paulo',
            'dateFormat' => 'php:dd/MM/Y - H:mm:ss',
            'datetimeFormat'=>'php:d/m/Y - H:m:s'
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.0.11']
    ];
}

return $config;
