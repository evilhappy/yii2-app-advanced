<?php

//define('G_LEVEL', 1);
//define('SDK_LOG_LEVEL', 1);
//define('SDK_LOG_FILE_PATH', '/tmp/unionpay/');
//.cer的证书是通用的。
//.pfx的根据商户号

return [
    'class' => 'pay\services\v1\pay\UnionPayService',
    //=======【基本信息设置】=====================================

    // ######(以下配置为PM环境：入网测试环境用，生产环境配置见文档说明)#######
    // 签名证书路径
    'SDK_SIGN_CERT_PATH' => __DIR__.'/daifu.pfx',

    //商户号
    'merId' => '898111453110474',

    // 签名证书密码
    'SDK_SIGN_CERT_PWD' => '160809',

    // 密码加密证书（这条一般用不到的请随便配）
    'SDK_ENCRYPT_CERT_PATH' => __DIR__.'/acp_prod_verify_sign.cer',

    // 验签证书路径（请配到文件夹，不要配到具体文件）
    'SDK_VERIFY_CERT_DIR' => __DIR__.'/',

    // 前台请求地址
    'SDK_FRONT_TRANS_URL' => 'https://gateway.95516.com/gateway/api/frontTransReq.do',

    // 后台请求地址
    'SDK_BACK_TRANS_URL' => 'https://gateway.95516.com/gateway/api/backTransReq.do',

    // 批量交易
    'SDK_BATCH_TRANS_URL' => 'https://gateway.95516.com/gateway/api/batchTrans.do',

    //单笔查询请求地址
    'SDK_SINGLE_QUERY_URL' => 'https://gateway.95516.com/gateway/api/queryTrans.do',

    //文件传输请求地址
    'SDK_FILE_QUERY_URL' => 'https://filedownload.95516.com/',

    //有卡交易地址
    'SDK_Card_Request_Url' => 'https://gateway.95516.com/gateway/api/cardTransReq.do',

    //App交易地址
    'SDK_App_Request_Url' => 'https://gateway.95516.com/gateway/api/appTransReq.do',

    //前台通知地址 (商户自行配置通知地址)
    'SDK_FRONT_NOTIFY_URL' => DOMAIN_PAY.'/v1/pay/order/unionpay-front-callback',

    //支付后台通知地址 (商户自行配置通知地址，需配置外网能访问的地址)
    'SDK_BACK_NOTIFY_URL' => DOMAIN_PAY.'/v1/pay/order/unionpay-callback',

    //退款 后台通知地址 (商户自行配置通知地址，需配置外网能访问的地址)
    'SDK_REFUND_BACK_NOTIFY_URL' => DOMAIN_PAY.'/v1/pay/order/refund-unionpay-callback',

    //文件下载目录
    'SDK_FILE_DOWN_PATH' => DOWNLOAD_PAY.'/unionpay',

    /** 以下缴费产品使用，其余产品用不到，无视即可 */
    // 前台请求地址
    'JF_SDK_FRONT_TRANS_URL' => 'https://gateway.95516.com/jiaofei/api/frontTransReq.do',
    // 后台请求地址
    'JF_SDK_BACK_TRANS_URL' => 'https://gateway.95516.com/jiaofei/api/backTransReq.do',
    // 单笔查询请求地址
    'JF_SDK_SINGLE_QUERY_URL' => 'https://gateway.95516.com/jiaofei/api/queryTrans.do',
    // 有卡交易地址
    'JF_SDK_CARD_TRANS_URL' => 'https://gateway.95516.com/jiaofei/api/cardTransReq.do',
    // App交易地址
    'JF_SDK_APP_TRANS_URL' => 'https://gateway.95516.com/jiaofei/api/appTransReq.do',
];