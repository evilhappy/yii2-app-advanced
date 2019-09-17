<?php
//------------------------BEGIN 需要配置区域---------------------------
defined('YII_DEBUG') or define('YII_DEBUG', true);
//域名
define('DOMAIN', 'abctime.com');
//支付网关地址
define('DOMAIN_PAY', 'http://test.pay.'.DOMAIN);
//文件地址
define('DOMAIN_FS', 'https://qnfile.abctime.com/');
define('DOMAIN_HEAD', 'http://portrait.abctime.com/');
//单词图片地址
define('DOMAIN_WORDS', 'https://qnwords.abctime.com/');
//API域地址
define('DOMAIN_API', 'http://test.api.'.DOMAIN);
//static域
define('DOMAIN_STATIC', 'http://test.static.admin.'.DOMAIN);
//h5域
define('DOMAIN_H5', 'http://test.static.h5.'.DOMAIN);
//GzhAPI域地址
define('DOMAIN_GZH_API', 'http://test.gzh.'.DOMAIN);
//WWW域地址
define('DOMAIN_WWW', 'http://test.www.'.DOMAIN);
// myStory 书籍开始日期
define('MY_STORY_DATE',1521648000);

define('DOMAIN_H5_SHARE', 'http://test.static.h5.abctime.com/mystory/index.html?');

// story 音频地址
define('DOMAIN_AUDIO_IPHONE', 'http://qnaudio.abctime.com/');

define('DOMAIN_AUDIO_IPAD', 'http://audio.abctime.com/');
//励步TV
define('DOMAIN_TV', 'https://test-realtime-tv.abctime.com');
//静态文件版本号
define('STATIC_VERSION', '1.000');
//APP名称
define('SITE_TITLE', 'ABCTIME');
//签名是否开启false关闭true开启
define('SIGN_STATUS', true);
//签名加密key
define('SIGN_KEY', 'GriE93gIGp$5bDjQ4rc20FzxWGghTIau');
//订单超时关闭(秒)
define('ORDER_TIMEOUT', 900);
//校验登录
define('CHECK_LOGIN',true);
//赠送优惠券
define('GIVE_COUNPON',true);
//hashIds盐
define('hashSalt', 'M0R$5n/L7s7');
//二次赠送
define('TWO_GIVE',false);
//审核ipad版本号
define('VERSION',8);
//审核phone版本号
define('PHONE_VERSION',13);
//兼容版本号
define('OLD_VERSION',35);
//测试发短信
define('SEND_MESSAGE', true);
//H5渠道领券活动
define('GET_COUPON', true);
//H5礼品卡活动
define('GIFT_CARD', true);
//APP用户绑定礼品卡活动
define('APP_GIFT_CARD', true);
//扫码开关
define('SCAN_STATUS', true);
//微信小程序提示开关
define('WECHAT_STATUS', true);

//微信服务号打卡通知模版ID
define('SIGN_TEMPLATE_ID', '3wRCufzSQ06nedmNHnuxGY5cK2zLymBtjuASCgLVeRw');

//视频课程开关
define('TV_STATUS', true);
//视频课程列表开关
define('TV_LIST_STATUS', true);
//励步TV-APPID
define('TV_APP_ID', '6');
//励步TV秘钥
define('TV_APP_SECRET', '16662cbf-0bb3-4b39-9d22-10638df6c492');
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
