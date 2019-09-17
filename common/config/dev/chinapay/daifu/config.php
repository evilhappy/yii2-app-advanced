<?php

//define('G_LEVEL', 1);
//define('SDK_LOG_LEVEL', 1);
//define('SDK_LOG_FILE_PATH', '/tmp/unionpay/');
//.cer的证书是通用的。
//.pfx的根据商户号

return [
    'class' => 'pay\services\v1\pay\ChinaPayService',
    //=======【基本信息设置】=====================================

    // ######(以下配置为PM环境：入网测试环境用，生产环境配置见文档说明)#######
    //商户签名私钥
    'MERPRK' => __DIR__.'/MerPrK.key',
    //ChinaPay 签名公钥
    'PGPUBK' => __DIR__.'/PgPubk.key',
    //商户号
    'merId' => '808080211880380',
    //ORA单笔交易请求地址
    'PAY_URL' => 'http://sfj-test.chinapay.com/dac/SinPayServletGBK',
    //ORA单笔交易请求地址
    'QRY_URL' => 'http://sfj-test.chinapay.com/dac/SinPayQueryServletGBK',
    //批量退单查询请求地址
    'BatchOrder_URL_QRY' => 'http://sfj-test.chinapay.com/dac/FailureTradeQueryGBK',
    //备付金余额查询请求地址
    'Balance_URL_QRY' => 'http://http://sfj-test.chinapay.com/dac/BalanceQueryGBK',
    //备付金明细查询请求地址
    'DepositDetail_URL_QRY' => 'http://sfj-test.chinapay.com/dac/DepositDetailQueryGBK'
];