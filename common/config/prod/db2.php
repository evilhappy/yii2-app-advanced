<?php
return [
    'class' => 'yii\db\Connection',
    //配置主服务器
    'dsn' => 'mysql:host=shengchan-db01.mysql.rds.aliyuncs.com;dbname=abctime_wechat',
    'username' => 'abctime_master',
    'password' => 'Abctime!@#$%',
    'charset' => 'utf8mb4',
    'tablePrefix' => 'wechat_',
    //false false false
    'emulatePrepare'=>false,
    'attributes' => [
        // use a smaller connection timeout
        PDO::ATTR_TIMEOUT => 60,
    ],
    //开启表结构缓存（schema caching）提高性能
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 86400,
    'schemaCache' => 'cache',
    //配置从服务器
    'slaveConfig' => [
        'username' => 'abctime_slave',
        'password' => 'Abctime!@#$%',
        'charset' => 'utf8mb4',
        'tablePrefix' => 'wechat_',
        //false false false
        'emulatePrepare'=>false,
        //开启表结构缓存（schema caching）提高性能
        'enableSchemaCache' => true,
        'schemaCacheDuration' => 86400,
        'schemaCache' => 'cache',
        'attributes' => [
            // use a smaller connection timeout
            PDO::ATTR_TIMEOUT => 60,
        ],
    ],
    // 配置从服务器组
    'slaves' => [
        [
            'dsn' => 'mysql:host=shengchan-db02.mysql.rds.aliyuncs.com;dbname=abctime_wechat',
        ],
        [
            'dsn' => 'mysql:host=shengchan-db03.mysql.rds.aliyuncs.com;dbname=abctime_wechat'
        ],
    ],
];