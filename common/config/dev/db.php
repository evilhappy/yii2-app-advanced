<?php
return [
    'class' => 'yii\db\Connection',
    //配置主服务器
    'dsn' => 'mysql:host=39.106.186.87;dbname=abctime',
    'username' => 'root',
    'password' => 'AbcTime~!@#$%',
    'charset' => 'utf8mb4',
    'tablePrefix' => 'asl_',
    //false false false
    'emulatePrepare'=>false,
    'attributes' => [
        // use a smaller connection timeout
        PDO::ATTR_TIMEOUT => 120,
    ],
    //开启表结构缓存（schema caching）提高性能
//    'enableSchemaCache' => true,
//    'schemaCacheDuration' => 3600,
//    'schemaCache' => 'cache',
    // 配置从服务器
    'slaveConfig' => [
        'username' => 'root',
        'password' => 'AbcTime~!@#$%',
        'charset' => 'utf8mb4',
        'tablePrefix' => 'asl_',
        //false false false
        'emulatePrepare'=>false,
        //开启表结构缓存（schema caching）提高性能
//    'enableSchemaCache' => true,
//    'schemaCacheDuration' => 3600,
//    'schemaCache' => 'cache',
        'attributes' => [
            // use a smaller connection timeout
            PDO::ATTR_TIMEOUT => 120,
        ],
    ],
    // 配置从服务器组
    'slaves' => [
        ['dsn' => 'mysql:host=39.106.186.87;dbname=abctime'],
    ],
];
