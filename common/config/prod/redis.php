<?php
return [
    'class' => 'common\components\ClientRedis',
    'conf' => [
        'master' => [
            ['host'=>'r-2ze018417401a804.redis.rds.aliyuncs.com','port'=>'6379','password'=>'9929Abctime','dbname'=>1],
        ],
        'slave' => [
            ['host'=>'r-2ze018417401a804.redis.rds.aliyuncs.com','port'=>'6379','password'=>'9929Abctime','dbname'=>1],
        ],
    ]
];