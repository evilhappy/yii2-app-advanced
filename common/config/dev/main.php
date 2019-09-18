<?php
return [
    'timeZone'=>'Asia/Shanghai',
    'language' =>'zh-CN',
    'bootstrap' => ['log'],
    'vendorPath' => dirname(dirname(dirname(__DIR__))) . '/vendor',
    'runtimePath' => BASE_DATA.'/web/'.YII_ENV.'/runtime',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],

        'db'        => require(dirname(__DIR__) . '/'.YII_ENV.'/db.php'),
//        'db2'        => require(dirname(__DIR__) . '/'.YII_ENV.'/db2.php'),
        'redis' => require(dirname(__DIR__) . '/'.YII_ENV.'/redis.php'),
        'logger' => [
            'class' => 'common\components\Logger',
            'logKey' => 'logstash:php_log',
        ],
        'clientRedis' => [
            'class' => 'common\components\ClientRedis',
        ],
        'mailer' => require(dirname(__DIR__) . '/'.YII_ENV.'/mail.php'),
        'wechat' => require(dirname(__DIR__) . '/'.YII_ENV.'/wechat/app/config.php'),
        'gpush' => require(dirname(__DIR__) . '/'.YII_ENV.'/gpush.php'),
        'aliOss' => require(dirname(__DIR__) . '/'.YII_ENV.'/oss.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'elasticsearch' => [
//            'class' => 'yii\elasticsearch\Connection',
//            'nodes' => [
//                ['http_address' => '10.40.11.225:9200'],
//            ],
//        ],
    ],
    'params' => yii\helpers\ArrayHelper::merge(
        require(dirname(__DIR__).'/params.php'),
        require(__DIR__.'/params.php')
    ),
];