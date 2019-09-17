<?php
/**
 * User: jingyanlei
 * Date: 2015/12/23
 * Time: 14:52
 * 自定义记录log类。用于记录用户行为
 */

namespace common\components;

use common\libs\Tools;
use Yii;
use yii\base\Component;
use yii\helpers\FileHelper;

class Logger extends Component
{
    /**
     * @var 文件权限
     */
    public $fileMode;
    /**
     * @var int 目录权限
     */
    public $dirMode = 0775;

    /**
     * @var str 存日志的key
     */
    public $logKey = '';

    /**
     * @var 日志存放文件
     */
    public $logFile;

    /**
     * 日志类型 error_type推送到redis，info_type存入本地日志文件
     */
    public $error_type = ['error'];
    public $info_type = ['info', 'debug'];

    private $_logType = '';
    private $_content = '';
    private $_file = null;

    private $uuid;

    /**
     * debug 如果是debug，并且开启Yii_DEBUG 才存入debug
     */
    const DEBUG_TYPE = 'debug';

    /**
     * 日志文件初始化
     */
    public function init()
    {
        $this->uuid = uniqid();
        parent::init();
    }

    private function _createLogDir()
    {
        $logPath = dirname($this->logFile);
        if (!is_dir($logPath)) {
            FileHelper::createDirectory($logPath, $this->dirMode, true);
        }
    }

    /**
     * @param $logType 日志类型，err,info,debug
     * @param $content  日志内容
     * @param $file 日志文件
     * @return string   debug 开启才存入debug内容
     */
    public function log($logType, $content, $file = null)
    {
        if ($logType === self::DEBUG_TYPE && YII_DEBUG === false) {
            return '';
        }
        $logTypeTemp = array_merge($this->info_type, $this->error_type);
        if (empty($logType) || !in_array($logType, $logTypeTemp)) {
            return false;
        }
        $this->_logType = $logType;
        $this->_content = $content;
        if (in_array($this->_logType, $this->info_type)) {
            $this->_file = $file;
            return $this->_logToFile();
        } elseif (in_array($this->_logType, $this->error_type)) {
            $this->_file = $file;
            return $this->_logToFile();
            // 上线后改成存入redis
            // return $this->_logToRedis();
        }
        return false;
    }

    /**
     * 获取日志内容
     * @return string   返回日志内容json串
     */
    private function _getText()
    {
        $messages = ['type' => $this->_logType, 'content' => $this->_content];
        $data['ip'] = Tools::getClientIp();
        $data['time'] = date("Y-m-d H:i:s");
        $data['request_id'] = $this->uuid;
        $controller_obj = Yii::$app->controller;
        if (is_object($controller_obj)) {
            if ($this->_logType == 'debug' || $this->_logType == 'error') {
                $_file = debug_backtrace();
                $_form = [];
                foreach ($_file as $_k => $_v) {
                    if (isset($_v['file'])) {
                        $file = $_v['file'];
                        if (strpos($file, '/vendor/yiisoft/yii2') === false && strpos($file, '/common/components/Logger.php') === false && strpos($file, '/web/index.php') === false) {
                            $_form[$_k]['file'] = $_v['file'];
                            $_form[$_k]['line'] = $_v['line'];
                            $_form[$_k]['function'] = $_v['function'];
                        }
                    }
                }
                unset($_file);
                $data['from'] = $_form;
            } else {
                $data['from'] = get_class($controller_obj) . '\\' . $controller_obj->action->actionMethod;
            }
        } else {
            $data['from'] = 'log';
        }
        $messages = array_merge($data, $messages);
        $text = json_encode($messages, JSON_UNESCAPED_UNICODE) . "\n";
        return $text;
    }

    private function _logToRedis()
    {
        $text = $this->_getText();
        $result = Yii::$app->redis->lPush($this->logKey, $text);
        if (!$result) {
            return false;
        }
        return true;
    }

    /**
     * @return string   debug 开启才存入debug内容
     */
    private function _logToFile()
    {
        $logFile = Yii::$app->getRuntimePath() . '/logs/' . date("Ym") . '/';
        //日志写入地址统一为/data/dev|test|prod/logs/...
//        $logFile = LOG_PATH . '/logs/'.date("Ym").'/';
        if ($this->_file != null) {
            $logFile = $logFile . date("Ymd") . '_' . $this->_logType . '_' . $this->_file . '.log';
        } else {
            $logFile = $logFile . date("Ymd") . '_' . $this->_logType . '.log';
        }
        $this->logFile = $logFile;
        $this->_createLogDir();

        $text = $this->_getText();
        if (($fp = @fopen($this->logFile, 'a')) === false) {
            return false;
        }
        @flock($fp, LOCK_EX);
        @fwrite($fp, $text);
        @flock($fp, LOCK_UN);
        @fclose($fp);

        if ($this->fileMode !== null) {
            @chmod($this->logFile, $this->fileMode);
        }
        return true;
    }
}
