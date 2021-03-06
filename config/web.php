<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TfzBJKgSNwQF8ZM4AKmhpbRpfhsFM4k_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'image' => [
                'class' => 'yii\image\ImageDriver',
                'driver' => 'GD',  //GD or Imagick
        ],
        'urlManager' => [
           'class' => 'yii\web\UrlManager',
           // Disable index.php
           'showScriptName' => false,
           // Disable r= routes
           'enablePrettyUrl' => true,
           'enableStrictParsing' => false,
           'rules' => [
                   '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                   '<module:\w+><controller:\w+>/<action:update|delete>/<id:\d+>' => '<module>/<controller>/<action>',
                   '<controller:\w+>/<id:\d+>' => '<controller>/view',
                   '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                   '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                   ['class' => 'yii\rest\UrlRule', 'controller' => 'location', 'except' => ['delete','GET', 'HEAD','POST','OPTIONS'], 'pluralize'=>false],
           ],
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            // send all mails to a file by default. You have to set
//            // 'useFileTransport' to false and configure a transport
//            // for the mailer to send real emails.
//            'useFileTransport' => true,
//        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'user' => [
//            'class' => 'amnah\yii2\user\components\User',
            'class' => 'app\modules\user\components\User',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
            'messageConfig' => [
                'from' => ['admin@website.com' => 'Admin'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ]
        ],
        'view' => [
          'theme' => [
              'pathMap' => [
                  '@app/modules/user/views' => '@app/views/user', // @app/views/user/default/login.php
              ],
          ],
    ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\Module',
//            'class' => 'amnah\yii2\user\Module',
            'layout' => '@app/views/layouts/login',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
