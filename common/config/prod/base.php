<?php
//------------------------BEGIN 需要配置区域---------------------------
defined('YII_DEBUG') or define('YII_DEBUG', false);
//域名
define('DOMAIN', 'abctime.com');
//支付网关地址
define('DOMAIN_PAY', 'https://pay.'.DOMAIN);
//文件地址
define('DOMAIN_FS', 'https://qnfile.abctime.com/');
define('DOMAIN_HEAD', 'http://portrait.abctime.com/');
//单词图片地址
define('DOMAIN_WORDS', 'https://qnwords.abctime.com/');
//C端地址
define('DOMAIN_M', 'https://m.'.DOMAIN);

//API域地址
define('DOMAIN_API', 'https://api.'.DOMAIN);
//static域
define('DOMAIN_STATIC', 'https://static.admin.'.DOMAIN);
//GzhAPI域地址
define('DOMAIN_GZH_API', 'http://gzh.'.DOMAIN);
//WWW域地址
define('DOMAIN_WWW', 'https://www.'.DOMAIN);
//h5域
define('DOMAIN_H5', 'http://static.h5.'.DOMAIN);

// myStory 书籍开始日期
define('MY_STORY_DATE',1523203200);

define('DOMAIN_H5_SHARE', 'https://static.h5.abctime.com/mystory/index.html?');

// story 音频地址
define('DOMAIN_AUDIO_IPHONE', 'http://qnaudio.abctime.com/');

define('DOMAIN_AUDIO_IPAD', 'http://audio.abctime.com/');
//励步TV
define('DOMAIN_TV', 'https://realtime-tv.abctime.com');
//静态文件版本号
define('STATIC_VERSION', '2.000');
//APP名称
define('SITE_TITLE', 'ABCTIME');
//签名是否开启false关闭true开启
define('SIGN_STATUS', true);
//签名加密key
define('SIGN_KEY', 'hkf%t5SMv1HtrVS!Y%B!NPNS!!0cWgy');
//自动确认收货时间 （天）
define('GOOD_AUTOCONFIRM_TIME',15);
//延迟收货时间（天）
define('GOOD_DELAY_TIME',3);
//延迟收货允许次数
define('GOOD_DELAY_NUMBER',1);
//订单超时关闭(3600秒)
define('ORDER_TIMEOUT', 3600);
//代卖商品默认加价比例
define('DESELL_RATE', 1.1);
//提现最新金额 单位分
define('MIN_FETCHMONEY', 10000);
//校验登录
define('CHECK_LOGIN',true);
//赠送优惠券
define('GIVE_COUNPON',false);
//hashIds盐
define('hashSalt', '1;C~73K6Sqr');
//二次赠送
define('TWO_GIVE',false);
//审核ipad版本号
define('VERSION',10);
//审核phone版本号
define('PHONE_VERSION',46);
//兼容版本号
define('OLD_VERSION',1);
//测试发短信
define('SEND_MESSAGE', false);
//H5渠道领券活动
define('GET_COUPON', true);
//H5礼品卡活动
define('GIFT_CARD', true);
//APP用户绑定礼品卡活动
define('APP_GIFT_CARD', true);
//扫码开关
define('SCAN_STATUS', true);
//微信小程序提示开关
define('WECHAT_STATUS', false);
//微信服务号打卡通知模版ID
define('SIGN_TEMPLATE_ID', 'U_sPOCYejiPccpHC86n5yvtQzPv5pUpsytVpAO9bZCg');

//视频课程开关
define('TV_STATUS', false);
//视频课程列表开关
define('TV_LIST_STATUS', false);
//励步TV-APPID
define('TV_APP_ID', '6');
//励步TV秘钥
define('TV_APP_SECRET', '5e040b2f-5d17-4f25-b0dd-4666dfa573d5');
//分表数量
define('TABLE_NUM', 10);
// 定级测试开关
define('TEST_SWITCH',false);
// 定级测试绘本限制
define('PLAN_LIMIT_BOOKNUM',4);
//云集APP_KEY
define('YJ_APP_KEY', 'abctime');
//云集AppSecret
define('YJ_APP_SECRET', 'D75733BF-FB77-40F9-8D41-030E928F53ABC');
//云集customerId
define('YJ_APP_CID', 'abctime');
//云集url
define('YJ_APP_URL', 10);
//------------------------END 需要配置区域-----------------------------