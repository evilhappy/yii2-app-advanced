<?php
return [
    'class' => 'common\libs\wechat\pay\Pay',
    //=======【基本信息设置】=====================================
    /**
     * TODO: 修改这里配置为您自己申请的商户信息
     * 微信公众号信息配置11
     * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
     * MCHID：商户号（必须配置，开户邮件中可查看）
     * TOKEN: Token(令牌)
     * EncodingAESKey : 消息加解密密钥
     * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
     * SIGNTYPE 加密方式
     * NOTIFY_URL 微信回调通知地址
     * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
     * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置），
     * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
     * @var string
     */
    'APPID' => 'wx8607461c8eb05eb5',
    'TOKEN' => 'abctimeprod',
    'APPSECRET' => '5f7d508346e2e5e683300ec38a4c4a4e',
    'EncodingAESKey' => '4aPTQP77J8PwcYfcsFO6fB9ZWrzaP1Mkfrvyj5kgFTu',
    'MCHID' => '1489111532',
    'KEY' => 'ABCtime1U318e2110c60Fc11828f053O',
    'SIGN_TYPE' => 'MD5',
    'NOTIFY_URL' => DOMAIN_API.'/v2/pay/order/wechat-callback',
    //=======【证书路径设置】=====================================
    /**
     * TODO：设置商户证书路径
     * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
     * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
     * @var path
     */
    'SSLCERT_DIR' => __DIR__,
    'SSLCERT_PATH' => '/apiclient_cert.pem',
    'SSLKEY_PATH' => '/apiclient_key.pem',
    //=======【curl代理设置】===================================
    /**
     * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
     * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
     * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
     * @var unknown_type
     */
    'CURL_PROXY_HOST' => '0.0.0.0',     //"10.152.18.220";
    'CURL_PROXY_PORT' => '0',           //8080
    //=======【上报信息配置】===================================
    /**
     * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
     * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
     * 开启错误上报。
     * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
     * @var int
     */
    'REPORT_LEVENL' => '0'
];