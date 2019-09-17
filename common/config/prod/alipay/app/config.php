<?php
return [
    'class' => 'pay\services\v1\pay\AlipayService',
    //=======【基础信息设置】=====================================
    //支付网关URL
    'ALIPAY_URL' => 'https://openapi.alipay.com/gateway.do',
    //支付宝即时到帐无密退款地址
    'ALIPAY_REFUND_URL' => 'https://mapi.alipay.com/gateway.do?',
    //APPID
    'APP_ID' => '2019012263089572',
    //APP_SECRET
    'APP_SECRET' => 'uX3h9FSpy6mnN/JQg36YwQ==',
    //MD5 key
    'MD5_KEY' => 'q5bxqc3hswxmcpnorxrkefj82yg98mtd',
    //合作者身份ID
    'PARTNER' => '2088821098163387',
    //卖家支付宝账号
    'SELLER_ID' => 'abctimezfb@100tal.com',
    //付款账户名 必填，个人支付宝账号是真实姓名公司支付宝账号是公司名称
    'SELLER_NAME' => '北京乐读乐考教育科技有限公司',
    //支付服务器异步通知页面路径
    'NOTIFY_URL' => DOMAIN_API.'/v2/pay/order/alipay-callback',
    'NOTIFY_MALL_URL' => DOMAIN_API.'/v2/pay/mall-order/alipay-callback',
    //支付服务器同步通知页面路径
//    'RETURN_URL' => DOMAIN_API.'/v2/pay/order/alipay-return',
    //退款服务器异步通知页面路径 (支付宝即时到账批量退款无密接口接口)
//    'NOTIFY_REFUND_URL' => DOMAIN_API.'/v2/pay/order/refund-alipay-callback',
    //批量转帐服务器异步通知路径
//    'NOTIFY_TRANSFER_URL' => DOMAIN_API.'/v2/pay/order/transfer-alipay-callback',
    //参数编码字符集
    'INPUT_CHARSET' => 'UTF-8',
    //未付款交易的超时时间 m-分钟，h-小时，d-天，1c-当天
    'IT_B_PAY' => '1h',
    //签名方式RSA
    'SIGN_TYPE' => 'RSA2',
    //签名方式MD5
    'SIGN_TYPE_MD5' => 'MD5',
    //=======【证书路径设置】=====================================
    //阿里云公钥证书路径
    'ALIPAY_PUBLIC_KEY' =>'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAgW9ncimvpVGSZuZ6GlmIruiV1qvkJLk15G81SqWmFhtXhKBG8OVMlIQlLc9LVC24RKViH2kdjCqDpSpN322N0fwepCES7bhoMGCE4ebUJ59soGRXTSuZTvzq5r6KINfrbCxttutU9oBo28nKW7DoBQM97SW0+Kqtgaof1iLyuB1AgT7VUhqFk4tsbBq5VLJ7JcVUptrYK2S9prgdo0Z05blioIV5daEMOZ5yoWyR9FDkrDun9PH7waHMgSa5DmZA6VyNbIbIs8VTEypVDBhbG/BvwRH7AhY1Mxcw9tWDaum3o0sW7FMKrgCdl2KIeBxHjcMbFJJqlgVK3rLx4Afv0wIDAQAB',
    'RSA_PUBLIC_KEY' =>'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuQlqMg7yWW6wGhcBOTUd1TaflMZdD66BFKigr1IieWKpaRQ3H0CWTvbHPFnYeLsQhit4h5Nm9kee+9o/QTDJvk9dfdASSvlznc+QqxFWhN/nIugWvVSfXDfokXkmtbtgGiUbAZ7LGnGKBVCJrmuQAPD+0myAypPiUFoAheBWSWZguZ6J0gS5zEb9zCQm8CNF9Qjv/GYle52AXTifP+LMuJ43AlvBY/jt4jW1wWxuzEdmOd9/oyi15kpWpPrcP+6LQSYxfoEG3O4w9BcyBHRCFQ04dGmsEJ1v5WDpEnIPpnRo0OGc+cUpF/2FAVseV/NwU8dQPm3rACAB3tZsIIAEVwIDAQAB',
    //商户私钥证书路径
    'RSA_PRIVATE_KEY' => 'MIIEpgIBAAKCAQEAuQlqMg7yWW6wGhcBOTUd1TaflMZdD66BFKigr1IieWKpaRQ3H0CWTvbHPFnYeLsQhit4h5Nm9kee+9o/QTDJvk9dfdASSvlznc+QqxFWhN/nIugWvVSfXDfokXkmtbtgGiUbAZ7LGnGKBVCJrmuQAPD+0myAypPiUFoAheBWSWZguZ6J0gS5zEb9zCQm8CNF9Qjv/GYle52AXTifP+LMuJ43AlvBY/jt4jW1wWxuzEdmOd9/oyi15kpWpPrcP+6LQSYxfoEG3O4w9BcyBHRCFQ04dGmsEJ1v5WDpEnIPpnRo0OGc+cUpF/2FAVseV/NwU8dQPm3rACAB3tZsIIAEVwIDAQABAoIBAQCyS2UdeROCo0piyVnvcsQdR3X7WCwhySct7dJvPPhk+HF/A/CdV5G94sJV38jbhHzGm6qXEKx8kMSbr0+WFFnA3B6c9Vo7DiSeonumqp0wicLg+ru2kYzAwkqBqjhnknZmmuxr4kOYZmD1AAa6n4Bxt8YConRzPo4qmJ66YVEjhTHea0j7CLfr4IhYGRefPUTC1/tEf9fwBVXf7XVARJI2ISY0H3pltiVLhaYY3UnA8pVW9153Nm/GqwrvF63r3OLg3JIlurCHI27jxRJWjSREIwyV+uQFXsHrwlV5Rsr8IYFRIpIVvbmXd4reWC4IEPGDdYL76IlGON3pz9dIkaC5AoGBAPGzKcbM4z7hSGZU6bJcLpO1kRK27CY/XAqV+l8QxXW8hhvLcX10HaLrY1b/5iODxQ3hLnQ4VSTT8eqT5DPGjqRTP7U5w+9BBQMhlopK1E5Ues2fP2GUDVnEQS4wmXslSMvPnb2RD6I/lG9LsdK+Yy3Xqk192h9GpCJqmrF0KBtTAoGBAMP8BU5iRTxbDgMGgfzXKnzPFC2qnfDzMOqggLGIRdk3tqYrSSYhwgqBHeuVG8NYxaWYbaFmunPqYfucY+zrBLwgCYX1zkR/pKTBQNvDNdmdlusT6/hk2jokZgHuuWRxGUR/XL4UoszndkuMyzBAUBeXxu2oeIAH8Uw2psWrd9ZtAoGBALoooXuyITE0ORxAOIMcxu8TwHomk7pdwJmSrHV+KGgnXS+ZQX876PuryyaeEHa4LhUjpDD1lna4G7LuV6ydOQ5N5FrD9CqZ7K9dtmIrglwWa0NmbV3Nt361TvKxkfUsYWZBMaBpUx5HVB9osLy90Qvk+RGYZmECerbbXuxgp+drAoGBAJx5ii8EDO1ccbp+pqgdjqGpoB253HJ1aHfcAAQ+ni4I6n6Pjs6wI0HJxv7BxTHZnaxSIC2+XF2SI/sE6U9OcTBWj+Px1mcgVm7okQUlPchqpwU3ma5vr0C+sOcYF9MW7aqf2Yc16Kman/tABTaYEppTpxM28EagkMpd1Bd8iKidAoGBANL7Yqs6QcAk2If+7r8s0f2b4M7BhoFwJoJZEbySVz79Id0Y1by+dk3Bf/dip1iAmuML3o3SRRLu8mZkL/NG4PN08zVG4X0lwnVN7S3VwVWMsHs/JWLJpa7CvJhYvqMb8AHO0Y4nm7ydI9+bUQr55F7URJ3XDRjT7Xu8qMEpuNxE',
    //=======【curl设置】=====================================
    //阿里云ssl证书 https
    'SSL_PATH' => __DIR__.'/../cacert.pem',
    //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    'TRANSPORT'=>'http',
];