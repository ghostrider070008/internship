<?php
$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__.'/db_local.php') ?
    (require __DIR__ . '/db_local.php'):
    (require __DIR__ . '/db.php');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'auth'=> [
            'class' => '\app\components\AuthComponent',
            'auth_class' => 'app\models\Users',
        ],
        'response'=>[
            'formatters' => [
                \yii\web\Response::FORMAT_JSON =>[
                    'class'=> \yii\web\JsonResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],

            ],
        ],
        'authManager' => yii\rbac\DbManager::class,
        'rbac' => \app\components\RbacComponent::class,

        'request' => [
            'parsers' => [
                'application/json'=>\yii\web\JsonParser::class,
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'MM9pJ8EX9dJEuydzxMlKV4kPSNImOnDM',
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
            'useFileTransport' => false,
            'enableSwiftMailerLogging' => true,
            'transport' => [
                'class'=>'Swift_SmtpTransport',
                'host'=>'smtp.gmail.com',
                'username' => '*',
                'password' => '*',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'i18n'=>[
            'translations' => [
                'app*'=>[
                    'class'=>\yii\i18n\PhpMessageSource::class,
                    'fileMap'=>[
                        'app'=>'app.php',
                        'app/rbac'=>'rbac.php',
                    ]
                ]
            ]
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
                'class'=>\yii\rest\UrlRule::class,
                'controller'=>'api',



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
    'params' => $params,
];
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}
return $config;