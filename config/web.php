<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        \app\bootstrap\SetUp::class,
        \app\modules\user\Bootstrap::class,
        'log',
        'admin',
        'catalog',
        'actions',
        'review',
        'portfolio',
        'page',
        'colour',
        'order',
        'characteristic',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'user' => \app\modules\user\Module::class,
        'admin' => \app\modules\admin\Module::class,
        'gridview' => \kartik\grid\Module::class,
        'catalog' => \app\modules\catalog\Module::class,
        'faq' => \app\modules\faq\Module::class,
        'actions' => \app\modules\actions\Module::class,
        'review' => \app\modules\review\Module::class,
        'slide' => \app\modules\slide\Module::class,
        'portfolio' => \app\modules\portfolio\Module::class,
        'page' => \app\modules\page\Module::class,
        'colour' => \app\modules\colour\Module::class,
        'order' => \app\modules\order\Module::class,
        'characteristic' => \app\modules\characteristic\Module::class,
        'setting' => \app\modules\setting\Module::class,
    ],
    'components' => [
        'authManager' => \yii\rbac\DbManager::class,
        'request' => [
            'baseUrl' => '',
            'cookieValidationKey' => 'DVFh6s-BVgUa_0pL_ie_Dwt4y-a9iGa_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => \app\modules\user\models\User::class,
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
            'messageConfig' => [
                'from' => 'smolbanytest@mail.ru',
                'to' => 'smolbanytest@mail.ru'
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',
                'username' => 'smolbanytest@mail.ru',
                'password' => 'smallbany67',
                'port' => '465',
                'encryption' => 'ssl',
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
