<?php
/**
 * cookie 操作类
 * @author: jingyanlei
 * @date: 2015/12/30
 */

namespace common\libs;

use Yii;

class Cookies
{
    /**
     * 获取Cookie值
     * @param string $cookieName cookie 名
     * @return string 返回cookie值，不存在返回 ''
     */
    public static function getCookie($cookieName = '')
    {
        if (empty($cookieName)) {
            return '';
        }
        $cookies = Yii::$app->request->cookies;
        $cookieInfo = '';
        if (($cookie = $cookies->get($cookieName)) !== null) {
            $cookieInfo = $cookie->value;
        }
        return $cookieInfo;
    }

    /**
     * 设置cookie信息
     * @param $name     name of the cookie
     * @param $value    value of the cookie
     * @param int $expire domain of the cookie
     * @param string $path the path on the server in which the cookie will be available on. The default is '/'.
     * @param string $domain domain of the cookie
     * @param bool|false $secure whether cookie should be sent via secure connection
     * @param bool|true $httpOnly whether the cookie should be accessible only through the HTTP protocol.
     * @return true
     */
    public static function setCookie($name, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httpOnly = true)
    {
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => $name,
            'value' => $value,
            'expire' => $expire,
            'path' => $path,
            'domain' => $domain,
            'secure' => $secure,
            'httpOnly' => $httpOnly
        ]));
        return true;
    }

    /**
     * 删除cookie
     * @param string $cookieName name of cookie
     * @return bool failed is false. success is true
     */
    public static function removeCookie($cookieName = '')
    {
        if (empty($cookieName)) {
            return false;
        }
        Yii::$app->response->cookies->remove($cookieName);
        return true;
    }
}