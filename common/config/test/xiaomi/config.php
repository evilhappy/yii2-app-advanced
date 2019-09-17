<?php
return [
    'class' => 'pay\services\v1\pay\XiaomiService',
    //=======【基本信息设置】=====================================
    'APPID' => '2882303761517739471',
    'APPSECRET' => 'ISil61WRqT4Un8okTYufhA==',
    'VERIFY_SESSION_URL' => 'http://mis.migc.xiaomi.com/api/biz/service/verifySession.do',
    'QUERY_ORDER_URL' => 'http://mis.migc.xiaomi.com/api/biz/service/queryOrder.do',
    'NOTIFY_URL' => DOMAIN_API.'/v2/pay/order/xmi-callback',
];