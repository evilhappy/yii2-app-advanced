<?php
return [
    'class' => 'yii\db\Connection',
    //配置主服务器
//    'dsn' => 'mysql:host=172.17.232.20;dbname=asl_test',
    'dsn' => 'mysql:host=shengchan-db01.mysql.rds.aliyuncs.com;dbname=abctime_test',
    'username' => 'abctime_test',
    'password' => 'Abctime123456',
    'charset' => 'utf8mb4',
    'tablePrefix' => 'asl_',
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
        'username' => 'abctime_test',
        'password' => 'Abctime123456',
        'charset' => 'utf8mb4',
        'tablePrefix' => 'asl_',
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
        ['dsn' => 'mysql:host=shengchan-db01.mysql.rds.aliyuncs.com;dbname=abctime_test'],
    ],
];
