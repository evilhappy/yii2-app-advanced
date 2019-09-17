<?php
return [
    'class' => 'pay\services\v1\pay\AlipayService',
    //=======【基础信息设置】=====================================
    //支付网关URL
    'ALIPAY_URL' => 'https://openapi.alipay.com/gateway.do',
    //支付宝网关地址(新)(支付宝即时到帐无密退款地址)
    'ALIPAY_REFUND_URL' => 'https://mapi.alipay.com/gateway.do?',
    //APPID
    'APP_ID' => '2016051001383486',
    //APP_SECRET
    'APP_SECRET' => '183e54a26f99419ab5010202846ef35f',
    //MD5 key
    'MD5_KEY' => 'txhs0zqvpqpff7gkhre6b6c1pv8t1msa',
    //合作者身份ID
    'PARTNER' => '2088811228311076',
    //卖家支付宝账号
    'SELLER_ID' => 'jadele@soulmatelondon.cn',
    //付款账户名 必填，个人支付宝账号是真实姓名公司支付宝账号是公司名称
    'SELLER_NAME' => '北京素魅国际化妆品有限公司',
    //支付服务器异步通知页面路径
    'NOTIFY_URL' => DOMAIN_PAY.'/v1/pay/order/alipay-callback',
    //退款服务器异步通知页面路径 (支付宝即时到账批量退款无密接口接口)
    'NOTIFY_REFUND_URL' => DOMAIN_PAY.'/v1/pay/order/refund-alipay-callback',
    //批量转帐服务器异步通知路径
    'NOTIFY_TRANSFER_URL' => DOMAIN_PAY.'/v1/pay/order/transfer-alipay-callback',
    //参数编码字符集
    'INPUT_CHARSET' => 'UTF-8',
    //未付款交易的超时时间 m-分钟，h-小时，d-天，1c-当天
    'IT_B_PAY' => '1h',
    //签名方式RSA
    'SIGN_TYPE' => 'RSA',
    //签名方式MD5
    'SIGN_TYPE_MD5' => 'MD5',
    //=======【证书路径设置】=====================================
    //阿里云公钥证书路径
    'ALIPAY_PUBLIC_KEY' => __DIR__.'/alipay_public_key.pem',
    //商户私钥证书路径
    'RSA_PRIVATE_KEY' => __DIR__.'/rsa_private_key.pem',
    //=======【curl设置】=====================================
    //阿里云ssl证书 https
    'SSL_PATH' => __DIR__.'/../cacert.pem',
    //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    'TRANSPORT'=>'http',
];