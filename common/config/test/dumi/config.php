<?php
return [
    'class' => 'pay\services\v1\pay\DumiService',
    //=======【基本信息设置】=====================================
    'BOTID' => 'debff2ea-a880-b990-9a49-bc649c782d61',
    'APPSECRET' => 'K8WMUHGMQAFAQ1',//百度那边所给的 KEY
    'NOTIFY_URL' => DOMAIN_API.'/v2/pay/order/dumi-callback',
];