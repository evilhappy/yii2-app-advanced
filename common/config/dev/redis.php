<?php
return [
    'class' => 'common\components\ClientRedis',
    'conf' => [
        'master' => [
            ['host'=>'127.0.0.1','port'=>'6379','password'=>'AbcTime123456at','dbname'=>2],
        ],
        'slave' => [
            ['host'=>'127.0.0.1','port'=>'6379','password'=>'AbcTime123456at','dbname'=>2],
        ],
    ]
];