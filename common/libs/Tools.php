<?php
/**
 * 公用静态方法类
 */

namespace common\libs;

use Yii;

class Tools
{
    protected static $thread_id = null;

    /**
     * @Purpose: 处理ajax请求Tools返回的json数据，支持jsonp返回
     * @param int $code 信息代码
     * @param string $msg 提示信息
     */
    public static function ajaxJsonp($code = 200, $msg = '')
    {
        $encode = json_encode(array('code' => $code, 'msg' => $msg));
        if (\Yii::$app->request->get('callback') !== null) {
            $encode = trim(\Yii::$app->request->get('callback')) . "({$encode})";
        }
        echo $encode;
    }

    /**
     * 返回数据
     * @param int $code 信息代码
     * @param string $msg 提示信息
     * @param string $data 数据
     * @param int $type 返回格式 1 json, 2 array, 3 xml
     * @param int $msgType 1只返回数组第一个出错提示,2返回全部出错提示
     * @return json/array/xml
     */
    public static function result($code = 200, $msg = '', $data = '', $type = 1, $msgType = 1)
    {

        $code = intval($code);
        $errors = \Yii::$app->params['errors'];
        $_msg = '';
        if (array_key_exists($code, $errors)) {
            if (is_array($msg) && !empty($msg)) {
                //返回数组时不处理数据
                if ($type == 2) {
                    $_msg = $msg;
                } else {
                    //json xml 只返回第一个错误
                    if ($msgType == 1) {
                        $_msg = array_values($msg)[0];
                        $_msg = array_values($_msg)[0];
                    }
                }
            } else {
                $_msg = $errors[$code][0];
            }
        } else {
            if ($code == 99999 && $msg) {//五个9的时候，吐出自定义内容（可以有变量）
                $_msg = $msg;
            } else {
                $code = 9999;
                //\Yii::$app->logger->log('info',$msg.$data);
                $_msg = $errors[$code][0];
            }
        }
        $result = ['code' => $code, 'msg' => $_msg, 'data' => empty($data) ? NULL : $data];//空值返回NULL
        if ($type == 2) {
            //array
        } elseif ($type == 3) {
            //xml
        } else {
            $result = json_encode($result, JSON_UNESCAPED_UNICODE);
            if (Yii::$app->getRequest()->get('callback')) {
                $callback = Yii::$app->getRequest()->get('callback');
                $result = $callback . '(' . $result . ')';
            }
        }
        return $result;
    }

    /**
     * 给easyui返回数据专用方法
     * @param $rows
     * @param $total
     * @return string
     */
    public static function response($rows, $total)
    {
        return json_encode(['rows' => $rows, 'total' => $total], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 求两个时间戳的差 返回天数
     * @param $startdate
     * @param $enddate
     * @return int
     * Amber
     */
    public static function getDays($startdate, $enddate)
    {
        if (empty($startdate) || empty($enddate)) {
            return 0;
        }
        $days = ceil(($enddate - $startdate) / 86400);
        return $days;
    }

    /**
     * 生成加密串
     * @param $arr
     * @return string
     * Amber
     */
    public static function makeSign($arr, $key)
    {
        if (empty($arr)) {
            return $verifySign = sha1($key);
        }
        ksort($arr);
        $verifyStr = '';
        foreach ($arr as $k => $v) {
            $verifyStr .= $v;
        }
        $verifySign = sha1($verifyStr . $key);
        return $verifySign;
    }

    /**
     * 打印
     * @param array $var
     * @param int $exit
     * @param null
     */
    public static function dump($var, $exit = 0)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        if ($exit) {
            exit(0);
        }
    }

    /**
     * 过滤标点等
     * @param string $text
     * @return string
     */
    public static function filterText($text)
    {
        $text = str_replace("\n", ' ', ' ' . $text . ' ');
//        $parrten = "/[a-zA-Z]|'+/";
//        preg_match_all($parrten, $text, $arr);
//        return $arr[0];
        $text = str_replace(".", ' ', $text);
        $text = str_replace("’", "'", $text);
        $keyword = urlencode($text);//将关键字编码
        $keyword = preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%E3%80%82|%EF%BC%81|%EF%BC%8C|%EF%BC%9B|%EF%BC%9F|%EF%BC%9A|%E3%80%81|%E2%80%A6%E2%80%A6|%E2%80%9D|%E2%80%9C|%E2%80%98|%E2%80%99|%E2%80%94)+/", ' ', $keyword);
        return urldecode($keyword);
    }

    /**
     * 对一个二维数组遍历 并且取得某一个字段 以数组形式返回
     * @param array $array
     * @param string $field
     * @return array
     */
    public static function field($array, $field)
    {
        if (empty($array)) return [];
        return array_column($array, $field);
//        $result = [];
//        foreach($array as $key=>$value) {
//            if( isset($value[$field]) )
//                $result[] = $value[$field];
//        }
//
//        return $result;
    }

    /**
     * 二维数组循环 获取一位数组某一个字段的总和
     */
    public static function sum($array, $field)
    {
        $sum = [];
        foreach ($array as $key => $value) {
            $sum[] = (int)$value[$field];
        }

        return array_sum($sum);
    }

    /**
     * 数组循环按某一字段分组
     * @param $array
     * @param $field
     * @return array
     */
    public static function group($array, $field)
    {
        $result = [];
        foreach ($array as $Key => $Value) {
            $result[$Value[$field]][] = $Value;
        }

        return $result;
    }


    /**
     * 获取请求时间
     */
    public static function getRequestTime()
    {
        return $_SERVER['REQUEST_TIME'];
    }

    /**
     * 生成salt
     */
    public static function createSalt()
    {
        return substr(hash('sha256', md5(rand(100000, 999999))), 0, 12);
    }

    /**
     * 生成salt
     * @param int $length
     * @param string $prefix
     * @return string
     */
    public static function makeSalt($length = 32, $prefix = '')
    {
        $length = abs($length);
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,./?|';
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $randstr .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $prefix . $randstr;
    }

    /**
     * 生成文件名字符串
     * @param int $length
     * @return string
     */
    public static function makeName($length = 32)
    {
        $length = abs($length);
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $randstr .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $randstr;
    }

    /**
     * 返回默认seller_name 注册时候用到
     */
    public static function defaultSellerName($length = 8)
    {
        $length = abs($length);
        $chars = '0123456789';
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $randstr .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return 'wt' . $randstr;
    }

    /**
     * 生成订单号
     * A IAP订单号   B 新用户赠送  Z 礼品卡  C 手动开通会员 D 任务赠送会员 E 活动赠送
     * $length 截取长度
     * @return string
     */
    public static function buildOrderNo($params = '', $length = 20)
    {
        !empty($params) ? $params = $params : $params = '';
        $sn = $params . date('Ymd') . substr(implode(NULL, array_map('ord', str_split(md5(uniqid(md5(microtime(true)), true)), 1))), 0, 8) . mt_rand(100, 999);
        return substr($sn, 0, $length);
    }

    /**
     * 生成阅读报告编号
     * $length 截取长度
     * @return string
     */
    public static function buildReportNo($params = '', $length = 30, $pre = '')
    {
        !empty($params) ? $params = $params : $params = '';
        $unData = str_split(implode(NULL, array_map('ord', str_split(md5(uniqid($pre . md5(microtime(true)), true)), 1))), 1);
        $randUnData = array_rand($unData, 10);
        $ranStr = '';
        foreach ($randUnData as $v) {
            $ranStr .= $unData[$v];
        }
        $sn = $params . date('YmdHis') . $ranStr . mt_rand(100000, 999999);
        return substr($sn, 0, $length);
    }

    /**
     * 验证变量是否已定义
     * @param $params 数组
     * @param $var 变量
     * @param $default 默认值
     * @return string
     */
    public static function checkIsSet($params, $var, $default = '')
    {
        if (is_array($params) && !empty($var)) {
            return isset($params[$var]) ? trim($params[$var]) : $default;
        } else {
            return '';
        }
    }

    /**
     * 安全过滤
     * @param $var
     * @return string
     */
    public static function encode($var)
    {
//        return \yii\helpersen\HtmlPurifier::process($var);
//        return \yii\helpers\Html::encode($var);
        return $var;
    }

    /**
     * 获取客户端IP
     * @return string
     */
    public static function getClientIp()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
            $ip = getenv("REMOTE_ADDR");
        } else if (isset ($_SERVER ['REMOTE_ADDR']) && $_SERVER ['REMOTE_ADDR'] && strcasecmp($_SERVER ['REMOTE_ADDR'], "unknown")) {
            $ip = $_SERVER ['REMOTE_ADDR'];
        } else {
            $ip = "unknown";
        }
        return ($ip);
    }

    /**
     * array转json
     * @param $array
     * @return json
     */
    public static function arrayToJson($array)
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    /**
     * josnToArray
     * @param $json
     * @return array
     */
    public static function jsonToArray($json)
    {
        return json_decode($json, true);
    }

    /**
     * 时间轴
     * $return array
     */
    public static function tranTime($time)
    {
        $rtime = date("m-d", $time);
        $htime = date("H:i", $time);
        $weekarray = array("日", "一", "二", "三", "四", "五", "六");
        $wtime = "周" . $weekarray[date("w", $time)];
        $nowTime = strtotime(date('Y-m-d', self::getRequestTime()));
        $time = $nowTime - $time;
        if ($time < 0) {
            $timeArr = [
                'day' => '今天',
                'time' => $htime
            ];

        } elseif ($time < 86400) {

            $timeArr = [
                'day' => '昨天',
                'time' => $htime
            ];

        } else {
            $timeArr = [
                'day' => $wtime,
                'time' => $htime
            ];
        }
        return $timeArr;
    }

    /**
     * xml 转换成数组
     * @param string $xml
     * @return array
     */
    public static function xmlToArray($xml)
    {
        $xml_parser = xml_parser_create();
        if (!xml_parse($xml_parser, $xml, true)) {
            xml_parser_free($xml_parser);
            $arr = false;
        } else {
            $xmlObj = simplexml_load_string(
                $xml,
                'SimpleXMLIterator',   //可迭代对象
                LIBXML_NOCDATA
            );
            $arr = [];
            $xmlObj->rewind(); //指针指向第一个元素
            while (1) {
                if (!is_object($xmlObj->current())) {
                    break;
                }
                $arr[$xmlObj->key()] = $xmlObj->current()->__toString();
                $xmlObj->next(); //指向下一个元素
            }
        }
        return $arr;
    }

    /**
     * 生成VIP邀请码
     */
    public static function createInviteCode($num = 16)
    {
        $char = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $invite_code = '';
        for ($i = 0; $i < $num; $i++) {
            // 取字符数组 $chars 的任意元素
            $invite_code .= $char[mt_rand(0, strlen($char) - 1)];
        }
        return $invite_code;
    }

    /**
     * 返回线程id+6位随机数
     * goods_attr用到,获取全局唯一id,来区分不同的规格
     */
    public static function getThreadId()
    {
        if (self::$thread_id === null) {
            self::$thread_id = intval(posix_getpid() . mt_rand(999, 999999));
        } else {
            self::$thread_id++;
        }

        return self::$thread_id;
    }

    /**
     * 返回指定位数的整数值
     * @param int $length
     * @return int
     */
    public static function makeInt($length = 8)
    {
        $elements = range(1, 9);
        shuffle($elements);

        $int = $elements[0];
        $elements[] = 0;
        shuffle($elements);
        for ($i = 0; $i < $length - 1; $i++) {
            $int .= $length[$i];
        }

        return $int;
    }

    /**
     * 获得css js文件全路径
     * @param  string $file
     * @return string
     */
    public static function staticUrl($file, $dir = 'front')
    {
        switch ($dir) {
            case 'admin':
                $dir = 'admin/manager-back/';
                break;
            case 'brand':
                $dir = 'admin/brand-back/';
                break;
            case 'www':
                $dir = 'front/www/www/';
                break;
            case 'front':
                $dir = 'front/m/';
                break;
            default:
                $dir = $dir . '/';
                break;
        }
        return DOMAIN_STATIC . $dir . $file . '?v=' . STATIC_VERSION;
    }

    /**
     * 全局设置变量
     */
    public static function set($key, $value)
    {
        $GLOBALS[$key] = $value;
    }

    /**
     * 全局取得变量
     */
    public static function get($key)
    {
        return isset($GLOBALS[$key]) ? $GLOBALS[$key] : '';
    }

    /**
     * 返回商品价格的m端表示
     */
    public static function mGoodsPrice($fen, $clean = 0)
    {
        $fen = bcdiv($fen, 100, 2);
        switch ($clean) {
            case 1:
                return $fen;
                break;
            case 2:
                return sprintf("¥%s", $fen);
                break;
            case 3:
                return sprintf("%s", $fen);
                break;
            default:
                return sprintf("<em>¥</em>%s", $fen);
                break;
        }
    }


    /**
     * 根据图片路径获得图片完整URL
     * @param string $key
     * @param string $size
     * @return string
     */
    public static function getFsUrl($key, $size = '')
    {
        if (empty($key)) return $key;
        if (!is_array($key)) {
            return self::_fsUrl($key, $size);
        } else {
            $full = [];
            foreach ($key as $_key) {
                $full[] = self::_fsUrl($_key, $size);
            }

            return $full;
        }
    }

    protected static function _fsUrl($key, $size = '')
    {
        $pattern = '';
        if (!empty($size)) {
            $operator = '!';
            $pattern = $operator . $size;
        }
        if (substr($key, 0, 5) == 'fs://') {
            return DOMAIN_FS . substr($key, 5) . $pattern;     //1.0系统图片路径
        } else {
            if (stripos($key, 'http://') === false && stripos($key, 'https://') === false) {          //2.0系统图片路径
                return DOMAIN_FS . $key . $pattern;
            } else {                                            //自带http协议的图片忽略不做处理
                return $key . $pattern;
            }
        }
    }

    /**
     * 根据起始时间获取日期数组
     *
     */
    public static function getDateArr($start_date, $end_date)
    {

        $timeArr = range(strtotime($start_date), strtotime($end_date), 24 * 60 * 60);
        $timeArr = array_map(create_function('$v', 'return date("Y-m-d", $v);'), $timeArr);
        //sort($timeArr);
        return $timeArr;
    }

    /**
     * 返回商品价格的表示
     */
    public static function goodsPrice($price, $type = 1)
    {
        $price = bcdiv(intval($price), 100, 2);
        $tempArr = explode(".", $price);
        $priceArr = [
            'price' => $price,
            'yuan' => $tempArr[0],
            'fen' => $tempArr[1]
        ];
        if ($type == 2) {
            return $price;
        } else {
            return $priceArr;
        }
//        list($int, $float) = explode('.', $fen);
//        return sprintf("<em>&yen;</em>%s<i>.%s</i>", $int, $float);
    }

    /**
     * 返回商品价格 从元到分
     */
    public static function PricetoFen($price)
    {
        $fen = bcmul(floatval($price), 100);
//        $priceArr = [
//            'yuan' => $price,
//            'fen' => $fen
//        ];
        return $fen;
    }

    /*
     * 根据时间戳获取时间
     */
    public static function getDate($date, $type = 1)
    {
        $result = '';
        if (!empty($date)) {
            if ($type == 2) {
                $result = date('Y-m-d H:i:s', $date);
            } elseif ($type == 3) {
                $result = date('Y-m-d', $date);
            } else {
                $result = date('Y-m-d H:i', $date);
            }
        }
        return !empty($result) ? $result : '';
    }

    /**
     * 生成加密串sing
     * @param array $parmas
     * @return string
     */
    public static function getSign(array $parmas)
    {
        ksort($parmas);
        $verifyStr = '';
        foreach ($parmas as $k => $v) {
            $verifyStr .= $k . htmlspecialchars_decode($v);
        }
        $verifySign = hash('sha256', $verifyStr . SIGN_KEY);  //加密方式处理为哈希
        return $verifySign;
    }

    /**
     * @param $video_url 视频地址
     * @param $frames  第几帧
     * @return string  封面截图地址
     */
    public static function getVideoCover($video_url, $frames = 1)
    {
        if (empty($video_url)) {
            $cover = '';
        } else {
            $video_url = self::getFsUrl($video_url);
            $cover = $video_url . '?vframe/jpg/offset/' . $frames;
            $context = file_get_contents($cover);
            //临时文件
            $tmpimg = '/tmp/qrcode/' . Tools::makeName();
            file_put_contents($tmpimg, $context);
            $cover = 'video' . Tools::makeName(16) . '.jpg';
            $result = Upload::uploadPic($cover, $tmpimg);
            if ($result['code'] == 1) {
                $cover = $result['Key'];
                @unlink($tmpimg);
            } else {
                $cover = '';
            }
        }
        return $cover;
    }

    /**
     * 获取get post
     * @param $var key
     * @return string
     */
    public static function getRequest($key, $default = '')
    {
        $_var = Yii::$app->request->get($key, '');
        if (empty($_var)) $_var = Yii::$app->request->post($key, '');
        return (empty($_var)) ? $default : $_var;
    }

    /**
     * 限制一个int遍历只能在某个范围内
     * @param $var
     * @param $min
     * @param $max
     * @return int
     */
    public static function between($var, $min, $max)
    {
        $var = abs(intval($var));
        if ($var <= 0) {
            $var = $min;
        }
        if ($var >= 100) {
            $var = $max;
        }
        return $var;
    }

    /**
     * 获取赠送时间
     * @param int $start_time 开始时间
     * @param int $date_num 数量
     * @param int $date_type 1 月 2 天
     *
     * @return int
     */
    public static function getExpireTime($start_time = '', $date_num = 1, $date_type = 1)
    {
        if ($date_num == 0) return 0;
        $startTime = $start_time > 0 ? $start_time : Tools::getRequestTime();
        if ($date_type == 2) {
            $expireTime = strtotime(date("Y-m-d 23:59:59", strtotime("+$date_num day", $startTime)));
        } elseif ($date_type == 1) {
            $expireTime = strtotime(date("Y-m-d 23:59:59", strtotime("+$date_num month", $startTime)));
        } else {
            $expireTime = strtotime(date("Y-m-d 23:59:59", strtotime("+$date_num day", $startTime)));
        }

        return $expireTime;
    }

    /**
     * PHP 非递归实现查询该目录下所有文件
     * @param string $dir
     * @return array
     */
    public static function scanFiles($dir)
    {
        if (!is_dir($dir))
            return array();

        // 兼容各操作系统
        $dir = rtrim(str_replace('\\', '/', $dir), '/') . '/';
        // 栈，默认值为传入的目录
        $dirs = [[basename($dir), $dir]];
        // 放置所有文件的容器
        $rt = [];
        do {
            // 弹栈
            $dirData = array_pop($dirs);
            $dir = $dirData[1];
            // 扫描该目录
            $tmp = scandir($dir);

            foreach ($tmp as $f) {
                // 过滤. ..
                if ($f == '.' || $f == '..' || $f == '.DS_Store' || $f == '__MACOSX')
                    continue;

                // 组合当前绝对路径
                $path = $dir . $f;
                // 如果是目录，压栈。
                if (is_dir($path)) {
                    array_push($dirs, [$f, $path . '/']);
                } else if (is_file($path)) { // 如果是文件，放入容器中
                    $rt[$dirData[0]][] = $path;
                }
            }
        } while ($dirs); // 直到栈中没有目录
        return $rt;
    }

    /**
     * 获取连续天数
     * @param $day_list
     * @return int
     */
    public static function getContinueDay($day_list)
    {
        rsort($day_list);//降序
        //昨天开始时间戳 00:00:00
        $beginYesterday = strtotime(date("Y-m-d", strtotime("-1 day")));
        if ($beginYesterday > $day_list[0]) $days = 0;
        else $days = 1;
        $count = count($day_list);
        for ($i = 0; $i < $count - 1; $i++) {
            $lastBegin = $day_list[$i] - 86400;
            $lastEnd = $day_list[$i] - 1;
            if ($day_list[$i + 1] >= $lastBegin && $day_list[$i + 1] <= $lastEnd) {
                $days++;
            } else {
                break;
            }
        }
        return $days;
    }

    public static function curl_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $jsoninfo = json_decode($output, true);
        return $jsoninfo;
    }

    /**
     * 数组分页array_slice
     * $count  每页多少条数据
     * $page  当前第几页
     * $array  查询出来的所有数组
     * order 0 - 不变   1- 反序
     */
    public static function page_array($count, $page, $array, $order = 0)
    {
        $countpage = array();

        $page = (empty($page)) ? '1' : $page;

        $start = ($page - 1) * $count;
        if ($order == 1) {
            $array = array_reverse($array);
        }

        $totals = count($array);
        $countpage = ceil($totals / $count);
        $pagedata = array();
        $pagedata = array_slice($array, $start, $count);

        return $pagedata; #返回查询数据
    }

    /**
     * 二维数组根据某个字段排序
     * @param array $array 要排序的数组
     * @param string $keys 要排序的键字段
     * @param string $sort 排序类型  SORT_ASC     SORT_DESC
     * @return array 排序后的数组
     */
    public static function arraySort($array, $keys, $sort = 'SORT_DESC')
    {
        $sort = array(
            'direction' => $sort, //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field' => $keys,       //排序字段
        );
        $arrSort = array();
        foreach ($array AS $uniqid => $row) {
            foreach ($row AS $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }

        if ($sort['direction']) {
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $array);
        }

        return $array;
    }


    /**
     * [array_group_by ph]
     * @param  [type] $arr [二维数组]
     * @param  [type] $key [键名]
     * @return [type]      [新的二维数组]
     */
    public static function array_group_by($arr, $key)
    {
        $grouped = array();
        foreach ($arr as $value) {
            $grouped[$value[$key]][] = $value;
        }
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $key => $value) {
                $parms = array_merge($value, array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by', $parms);
            }
        }
        // 重新排序
        foreach ($grouped as $date => $item) {
            $grouped[$date] = Tools::arraySort($item, 'create_time', 'SORT_DESC');
        }
        return $grouped;
    }

    /**
     * 下载
     * @param $path
     * @param $filePath
     * @return string
     */
    public static function downUrl($path, $filePath)
    {
        if (is_file($filePath)) {
            //判断文件名是否存在，存在则删除
            unlink($filePath);
//            return $filePath;
        }
        $fp_output = fopen($filePath, 'w+');
        $ch = curl_init($path);
        curl_setopt($ch, CURLOPT_FILE, $fp_output);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp_output);
        return $filePath;
    }

    /**
     * 清除emoji表情
     * @param $nickname
     * @return null|string|string[]
     */
    public static function removeEmoji($text)
    {

        $clean_text = "";

        // Match Emoticons
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clean_text = preg_replace($regexEmoticons, '', $text);

        // Match Miscellaneous Symbols and Pictographs
        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clean_text = preg_replace($regexSymbols, '', $clean_text);

        // Match Transport And Map Symbols
        $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clean_text = preg_replace($regexTransport, '', $clean_text);

        // Match Miscellaneous Symbols
        $regexMisc = '/[\x{2600}-\x{26FF}]/u';
        $clean_text = preg_replace($regexMisc, '', $clean_text);

        // Match Dingbats
        $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
        $clean_text = preg_replace($regexDingbats, '', $clean_text);

        return $clean_text;
    }

    /**
     * 切割数组
     * @param $array 一维数组
     * @param $value 开始元素值
     * @param $enum 结果数组个数
     * @param $status 1next 0cur
     * @return array
     */
    public static function splitArray($array, $value, $enum, $status = 0)
    {
        if (empty($array)) return array();
        //个数
        $enum = intval($enum);
        //开始位置
        $start = ($value == 0) ? 0 : array_search($value, $array);
        $start = $start + $status;
        $result = array_slice($array, $start, $enum);
        $countResult = count($result);
        if ($countResult < $enum) {
            $result = array_merge($result, array_slice($array, 0, $enum - $countResult));
        }
        return $result;
    }

    /**
     * 判断字符串是否base64编码
     */
    public static function func_is_base64($str)
    {
        return $str == base64_encode(base64_decode($str)) ? true : false;
    }

    /**
     * 压缩内容
     */
    public static function func_gzcompress($str, $level = 6)
    {
        if (empty($str)) return '';
        if (!self::func_is_base64($str)) {
            return base64_encode(gzcompress($str, $level));
        }
        return $str;
    }

    /**
     * 解压内容
     */
    public static function func_gzuncompress($str)
    {
        if (empty($str)) return '';
        if (self::func_is_base64($str)) {
            return gzuncompress(base64_decode($str));
        }
        return $str;
    }

    /**
     * 请求gzh接口处理拼团逻辑
     * @param $params
     * @return array
     */
    public static function groupOrderCallBack($params)
    {
        $params = [
            'order_sn' => $params['order_sn'],
            'parent_order_sn' => $params['parent_order_sn'],
            'product_id' => $params['product_id'],
            'version' => 1000
        ];
        $params['sign'] = Tools::getSign($params);
        $uri = DOMAIN_GZH_API . '/v3/group/month-card/api-callback';
        $config = ['host' => DOMAIN, 'timeout' => 30, 'connect_time_out' => 3];
        $curl = new Curl($config);
        $result = $curl->post($uri, $params);
        Yii::$app->logger->log('info', ['url' => $uri, 'params' => $params, 'result' => $result], 'GroupGzhOrderCallBack');
        return $result;
    }

    /**
     * 根据 source 判断是否是 ios
     * @param $source
     * @return bool
     */
    public static function isIos($source)
    {
        return in_array($source, Yii::$app->params['iOSSource']);
    }

    /**
     * 根据 source 判断是否是 android
     * @param $source
     * @return bool
     */
    public static function isAndroid($source)
    {
        return in_array($source, Yii::$app->params['androidSource']);
    }

    /**
     * 压缩文件
     * @param $path
     * @param $zip
     */
    public static function addFileToZip($path, $zip, $basePath)
    {
        if ($zip == null) {
            return false;
        }
        $path .= (substr($path, -1, strlen('/')) == '/') ? "" : "/";
        $handler = opendir($path); //打开当前文件夹由$path指定。
        while (($fileName = readdir($handler)) !== false) {
            if ($fileName != "." && $fileName != ".." && $fileName != ".DS_Store" && $fileName != "__MACOSX" && $fileName != "Thumbs.db") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
                $filePath = $path . $fileName;
                if (is_dir($filePath)) {// 如果读取的某个对象是文件夹，则递归
                    self::addFileToZip($filePath, $zip, $basePath);
                } else { //将文件加入zip对象
                    if (file_exists($filePath) && is_file($filePath)) {
                        $zip->addFile($filePath, str_replace($basePath, '', $filePath));

                    }
                }
            }
        }
        @closedir($path);
    }

    /**IOS 是否审核态
     * @param $source
     * @param $version
     * @return int
     */
    public static function iosCheckStatus($source, $version)
    {
        if (self::isIos($source) && $version == PHONE_VERSION) {
            return 1;
        }
        return 0;
    }

    /**
     * 头像url域名替换
     * @param $url
     * @return mixed
     */
    public static function setHeadImgUrl($url)
    {
        if (empty($url)) return '';
        return str_replace(DOMAIN_FS, DOMAIN_HEAD, $url);
    }


    /**获取IP地址
     * @return string
     */
    public static function get_client_ip()
    {
        $ip = '';
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
    }

    /**
     *  iOS 安卓
     * @param int $source 来源
     * @param int version 版本
     * @param int $frontVersion 前端版本
     * @return int
     */
    public static function checkStatus($source, $version, $frontVersion = 252)
    {
        if (self::isIos($source) && $version >= Yii::$app->params['iosVersion'][$frontVersion]) {
            return 0;
        }
        if (self::isAndroid($source) && $version >= Yii::$app->params['androidVersion'][$frontVersion]) {
            return 0;
        }
        return 1;

    }

    /**生成md5 sign值
     * @param $params
     * @param $secret 秘钥
     * @return string
     */
    public static function makeMd5Sign($params, $secret)
    {
        if (isset($params['sign'])) {
            unset($params['sign']);
        }
        #生成服务端sign
        $str = "";
        ksort($params);
        foreach ($params as $k => $v) {
            $str .= $k . $v;
        }
        $serverSign = md5($str . $secret);
        //echo $serverSign;
        return $serverSign;
    }

    /**检查sign值
     * @param $params
     * @param $secret
     * @param $clientSign
     * @return bool
     */
    public static function checkSign($params, $secret, $clientSign)
    {
        $serverSign = self::makeMd5Sign($params, $secret);
        if ($serverSign == $clientSign) {
            return true;
        } else {
            return false;
        }
    }

    /**比较两个时间戳的差（去除时分秒比较）
     * @param $date1
     * @param $date2
     */
    public static function timestampInterval(int $timestamp1, int $timestamp2, $format = '%a')
    {
        $date1 = new \DateTime(date('Y-m-d', $timestamp1));
        $date2 = new \DateTime(date('Y-m-d', $timestamp2));
        $interval = $date1->diff($date2)->format($format);
        return $interval;
    }

    /**获取当天时间的最后一秒
     * @return false|int
     */
    public static function getTodayEnd()
    {
        return strtotime(date('Y-m-d')) + 86400 - 1;
    }

    /**
     * 根据数组中键值排序
     * @param $array
     * @param $field
     * @param bool $desc 是否倒序
     */
    public static function sortArrayByField(&$array, $field, $desc = false)
    {
        if (empty($array)) {
            return;
        }
        $fieldArr = [];
        foreach ($array as $k => $v) {
            $fieldArr[$k] = $v[$field];
        }
        $sort = $desc == false ? SORT_ASC : SORT_DESC;
        array_multisort($fieldArr, $sort, $array);
    }

    /**
     * 根据数组中多个键值排序
     * @return mixed|null
     */
    public static function sortArrayByManyField()
    {
        $args = func_get_args();
        if (empty($args)) {
            return null;
        }
        $arr = array_shift($args);
        if (empty($arr) || !is_array($arr)) {
            return null;
        }
        foreach ($args as $key => $field) {
            if (is_string($field)) {
                $temp = array();
                foreach ($arr as $index => $val) {
                    $temp[$index] = $val[$field];
                }
                $args[$key] = $temp;
            }
        }
        $args[] = &$arr;//引用值
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }
}