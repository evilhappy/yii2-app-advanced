<?php
$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'aa7e33802!b@d#0$1%9^0&8*c9073d1b4941fe85',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    //表示以yii\db\或者app\models\开头的分类都会写入这个文件
                    'categories' => ['yii\db\*'],
                    'logFile' => BASE_DATA . '/web/' . YII_ENV . '/runtime/sql' . date("Y-m-d", time()) . '.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => BASE_DATA . '/web/' . YII_ENV . '/runtime/requests' . date("Y-m-d", time()) . '.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                "<controllers:\w+>/<action:\w+>" => "<controllers>/<action>",
            ]
        ],
    ],
    'modules' => [
        'v1' => [
            'class' => 'backend\modules\v1\Module',
            'modules' => [
                'user' => 'backend\modules\v1\user\Module',
            ]
        ],
//        'v2' => [
//            'class' => 'backend\modules\v2\Module',
//            'modules' => [
//
//            ]
//        ],
    ],
];
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'historySize' => 500,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
return $config;