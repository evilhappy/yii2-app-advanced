<?php
return [
    'timeZone'=>'Asia/Chongqing',
    'language' =>'zh-CN',
    'bootstrap' => ['log'],
    'vendorPath' => dirname(dirname(dirname(__DIR__))) . '/vendor',
    'runtimePath' => ASL_DATA.'/web/'.YII_ENV.'/runtime',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],

        'db'        => require(dirname(__DIR__) . '/'.YII_ENV.'/db.php'),
        'db2'        => require(dirname(__DIR__) . '/'.YII_ENV.'/db2.php'),
        'redis' => require(dirname(__DIR__) . '/'.YII_ENV.'/redis.php'),
        'logger' => [
            'class' => 'common\components\Logger',
            'logKey' => 'logstash:php_log',
        ],
        'clientRedis' => [
            'class' => 'common\components\ClientRedis',
//            'conf' => require(dirname(__DIR__) . '/'.YII_ENV.'/redis.php'),
        ],
        'mailer' => require(dirname(__DIR__) . '/'.YII_ENV.'/mail.php'),
        'rsa' => require(dirname(__DIR__) . '/'.YII_ENV.'/rsa.php'),
        'huaWei' => require(dirname(__DIR__) . '/'.YII_ENV.'/huawei/config.php'),
        'huaWei2' => require(dirname(__DIR__) . '/'.YII_ENV.'/huawei/config2.php'),
        'xiaomi' => require(dirname(__DIR__) . '/'.YII_ENV.'/xiaomi/config.php'),
        'dumi' => require(dirname(__DIR__) . '/'.YII_ENV.'/dumi/config.php'),
        'oppo' => require(dirname(__DIR__) . '/'.YII_ENV.'/oppo/config.php'),
        'lenovo' => require(dirname(__DIR__) . '/'.YII_ENV.'/lenovo/config.php'),
        'vivo' => require(dirname(__DIR__) . '/'.YII_ENV.'/vivo/config.php'),
        'wechatApp' => require(dirname(__DIR__) . '/'.YII_ENV.'/wechat/app/config.php'),
        'wechatH5' => require(dirname(__DIR__) . '/'.YII_ENV.'/wechat/h5/config.php'),
        'wechatH5v2' => require(dirname(__DIR__) . '/'.YII_ENV.'/wechat/h5v2/config.php'),
        'alipayApp' => require(dirname(__DIR__) . '/'.YII_ENV.'/alipay/app/config.php'),
        'alipayH5' => require(dirname(__DIR__) . '/'.YII_ENV.'/alipay/h5/config.php'),
        'unionpayApp' => require(dirname(__DIR__) . '/'.YII_ENV.'/unionpay/app/config.php'),
        'unionpayH5' => require(dirname(__DIR__) . '/'.YII_ENV.'/unionpay/h5/config.php'),
        'daifuH5' => require(dirname(__DIR__) . '/'.YII_ENV.'/unionpay/daifu/config.php'),
        'chinaPayDaifu' => require(dirname(__DIR__) . '/'.YII_ENV.'/chinapay/daifu/config.php'),
        'gpush' => require(dirname(__DIR__) . '/'.YII_ENV.'/gpush.php'),
        'qiniu' => require(dirname(__DIR__) . '/'.YII_ENV.'/qiniu.php'),
        'aliOss' => require(dirname(__DIR__) . '/'.YII_ENV.'/oss.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => '172.17.232.19:9200'],
            ],
        ],
    ],
//    'params' => require(dirname(__DIR__) . '/params.php'),
    'params' => yii\helpers\ArrayHelper::merge(
        require(dirname(__DIR__).'/params.php'),
        require(__DIR__.'/params.php')
    ),
];