<?php
$params = require __DIR__ . '/params.php';
/*$db = require __DIR__ . '/db.php';*/

$db = file_exists(__DIR__.'/db_local.php')?(require __DIR__.'/db_local.php'):(require __DIR__.'/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'auth'=> [
            'class' => '\app\components\AuthComponent',
            'auth_class' => 'app\models\Users',
        ],
        'authManager' => yii\rbac\DbManager::class,
        'rbac' => \app\components\RbacComponent::class,
        /*'profile' => [
            'class' =>
        ],*/
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'D9ToPkV7-0dkhzTXSar7j7Om7Iq0f-E2',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        /*'authClientCollection' => [
            'class'   => \yii\authclient\Collection::class,
            'clients' => [
                // here is the list of clients you want to use
                // you can read more in the "Available clients" section
                'facebook' => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => 'APP_ID',
                    'clientSecret' => 'APP_SECRET',
                ],
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
                'vkontakte' => [
                    'class'        => 'dektrium\user\clients\VKontakte',
                    'clientId'     => '7128372',
                    'clientSecret' => '9d6bd7889d6bd7889d6bd788569d0712bc99d6b9d6bd788c01e81ac274fd68164146fe8',
                ]
            ],
        ],*/
    ],

    'modules' => [
        /*'user' => [
            'class' => 'dektrium\user\Module',
        ],*/
        'api' => [
            'basePath' => '@app/modules/api',
            'class' => 'app\modules\api\Module',
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
