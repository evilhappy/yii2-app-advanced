<?php
//------------------------BEGIN 需要配置区域---------------------------
//设置环境
include(dirname(dirname(__DIR__)).'/../.YII_ENV.php');

//短信过期时间 15分钟
define("MESSAGE_EXPIRE_TIME", '900');
//200状态成功
define('SUCCESS', 200);
define('BASE_DATA','/data');
//支付对帐单下载文件地址
define('DOWNLOAD_PAY', BASE_DATA.'/download/'.YII_ENV);
//日志写入地址
define('LOG_PATH', BASE_DATA.'/web/'.YII_ENV);
//系统维护
define('SYSTEM_REST', false);
//各环境常量配置
require_once(YII_ENV.'/base.php');
