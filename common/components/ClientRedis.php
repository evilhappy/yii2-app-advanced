<?php

namespace common\components;

use Yii;
use yii\base\Component;

class ClientRedis extends Component
{
    public static $instance = NULL;
    public static $linkHandle = array();
    public $conf;

    /**
     * 获得redis Resources
     * @param null $key redis存的key/或随机值
     * @param string $tag  master/slave
     * @return mixed|\Redis|null
     */
    public function getRedis($key = null, $tag = 'master')
    {
        if (!empty(self::$linkHandle[$tag])) {
            return self::$linkHandle[$tag];
        }
        empty($key) ? $key = uniqid() : '';
        $this->conf = Yii::$app->redis->conf;
        $redis_arr = $this->conf[$tag];
        //获得相应主机的数组下标
        $arr_index = $this->getHostByHash($key, count($this->conf[$tag]));
        try {
            $obj = new \Redis();
            $status = $obj->pconnect($redis_arr[$arr_index]['host'], $redis_arr[$arr_index]['port']);
            if (!$status) {
                sleep(3);
                $status = $obj->pconnect($redis_arr[$arr_index]['host'], $redis_arr[$arr_index]['port']);
                if (!$status) {
                    Yii::$app->logger->log('info', 'redis:Redis connection fails');
                    return null;
                }
            }
            if ($redis_arr[$arr_index]['password']) {
                $ret = $obj->auth($redis_arr[$arr_index]['password']);
                if ($ret === false) {
                    Yii::$app->logger->log('info', 'redis:not allowed to cennect');
                    return null;
                }
            }
            $obj->select($redis_arr[$arr_index]['dbname']);
            self::$linkHandle[$tag] = $obj;
            return $obj;
        } catch (\Exception $e) {
            Yii::$app->logger->log('info', $e->getMessage());
            return null;
        }
    }

    /**
     * 随机取出主机
     * @param $key $变量key值
     * @param $n        主机数
     * @return string
     */
    private function getHostByHash($key, $n)
    {
        if ($n < 2) return 0;
        $u = strtolower($key);
        $id = sprintf("%u", crc32($key));

        $m = base_convert(intval(fmod($id, $n)), 10, $n);
        return $m{0};
    }

    /**
     * 关闭连接
     * pconnect 连接是无法关闭的
     *
     * @param int $flag 关闭选择 0:关闭 Master 1:关闭 Slave 2:关闭所有
     * @return boolean
     */
    public function close($flag = 2)
    {
        switch ($flag) {
            // 关闭 Master
            case 0:
                foreach (self::$linkHandle['master'] as $var) {
                    $var->close();
                }
                break;
            // 关闭 Slave
            case 1:
                foreach (self::$linkHandle['slave'] as $var) {
                    $var->close();
                }
                break;
            // 关闭所有
            case 2:
                $this->close(0);
                $this->close(1);
                break;
        }
        return true;
    }

    //------------------------------方法(主)----------------------------------------------

    /**
     * redis 字符串（String） 类型
     * 将key和value对应。如果key已经存在了，它会被覆盖，而不管它是什么类型。
     * @param $key
     * @param $value
     * @return string
     */
    public function set($key, $value)
    {
        $redis = $this->getRedis($key);
        return $redis->set($key, $value);
    }

    /**
     * 设置key对应字符串value，并且设置key在给定的seconds时间之后超时过期
     * @param $key
     * @param int $exp
     * @param $value
     * @return bool
     */
    public function setex($key, $exp = 0, $value)
    {
        $redis = $this->getRedis($key);
        return $redis->setex($key, $exp, $value);
    }

    /**
     * redis 字符串（String） 类型, 将key对应的value加1
     * @param $key
     * @return int
     */
    public function incr($key)
    {
        $redis = $this->getRedis($key);
        return $redis->incr($key);
    }

    /**
     * 设置一个key的过期时间
     * @param $key
     * @param $exp
     * @return bool
     */
    public function setExpire($key, $exp)
    {
        $redis = $this->getRedis($key);
        return $redis->expire($key, $exp);
    }

    /**
     * 重命名key
     * @param $oldkey
     * @param $newkey
     * @return bool
     */
    public function renameKey($oldkey, $newkey)
    {
        return $this->getRedis($oldkey)->rename($oldkey, $newkey);
    }

    /**
     * 删除一个或多个key
     * @param $keys
     * @return int
     */
    public function delKey($keys)
    {
        if (is_array($keys)) {
            foreach ($keys as $key) {
                return $this->getRedis($key)->del($key);
            }
        } else {
            return $this->getRedis($keys)->del($keys);
        }
    }

    /**
     * 添加一个字符串值到LIST容器的顶部（左侧），如果KEY不存在，曾创建一个LIST容器，如果KEY存在并且不是一个LIST容器，那么返回FLASE
     * @param $key
     * @param $val
     * @return bool|int
     */
    public function lPush($key, $val)
    {
        return $this->getRedis($key)->lPush($key, $val);
    }

    /**
     * 返回LIST顶部（左侧）的VALUE，并且从LIST中把该VALUE弹出。
     * @param $key
     * @return string
     */
    public function rPop($key)
    {
        return $this->getRedis($key)->rPop($key);
    }

    /**
     * 判断redis列表长度
     * @param $key 列表key
     * @return int
     */
    public function lLen($key)
    {
        return $this->getRedis($key)->lLen($key);
    }

    /**
     * 批量的添加多个key 到redis
     * @param $fieldArr
     * @return int
     */
    public function mSetnx($fieldArr)
    {

        return $this->getRedis()->mSetnx($fieldArr);
    }

    /**
     * 添加数组到redis
     * @param $key
     * @param $Arr
     * @return bool
     */
    public function setArr($key, $Arr)
    {
        $redis = $this->getRedis($key);
        $str = serialize($Arr);
        return $redis->set($key, $str);
    }

    //------------------------------方法(默认从，可指定主)----------------------------------------------
    /**
     * 返回key的value。如果key不存在，返回特殊值nil。如果key的value不是string，就返回错误，因为GET只处理string类型的values。
     * @param $key
     * @param string $tag
     * @return bool|string
     */
    public function get($key, $tag = 'slave')
    {
        return $this->getRedis($key, $tag)->get($key);
    }

    /**
     * 查找所有匹配给定的模式的键
     * @param $key
     * @param bool $is_key 默认是一个非正则表达试，使用模糊查询
     * @param string $tag
     * @return array
     */
    public function keys($key, $is_key = true, $tag = 'slave')
    {
        if ($is_key) {
            return $this->getRedis($key, $tag)->keys("*$key*");
        }
        return $this->getRedis($key, $tag)->keys("$key");
    }

    /**
     * 获取数组
     * @param $key
     * @param string $tag
     * @return array|mixed
     */
    public function getArr($key, $tag = 'slave')
    {
        $str = $this->getRedis($key, $tag)->get($key);
        if ($str) {
            return unserialize($str);
        }
        return array();
    }

    /**
     * redis lrange
     * @param $key
     * @param $start
     * @param $stop
     * @param string $tag
     * @return array
     */
    public function lrange($key, $start, $stop, $tag = 'slave')
    {
        return $this->getRedis($key, $tag)->lrange($key, $start, $stop);
    }

    /**
     * redis ltrim
     * @param $key
     * @param $start
     * @param $stop
     * @param string $tag
     * @return array
     */
    public function ltrim($key, $start, $stop, $tag = 'master')
    {
        return $this->getRedis($key, $tag)->ltrim($key, $start, $stop);
    }

    /**
     * redis lRemove
     * @param $key
     * @param $value
     * @param int $count
     * @param string $tag
     */
    public function lremove($key, $value, $count = 0, $tag = 'master')
    {
        return $this->getRedis($key, $tag)->lremove($key, $value, $count);
    }
}
