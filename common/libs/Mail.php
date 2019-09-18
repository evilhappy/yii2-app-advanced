<?php

namespace common\libs;

use Yii;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;

/**
 * Class Mail 邮件发送类
 * @author jingyanlei
 * @date 2016/01/06
 */
class Mail
{
    /**
     * 邮件发送
     * @param string/array $setTo     接收者
     * @param string $setSubject 发送主题
     * @param string $content 发送内容
     * @param string $view 视图  e.g.@common/mail/test"
     * @throws NotFoundHttpException
     * @return
     */
    public static function send($setTo = '', $setSubject = '', $content = '', $view = '')
    {
        if (empty($setTo) || empty($setSubject) || empty($content)) {
            return false;
        }
        $mailer = Yii::$app->mailer;
        if (is_string($setTo)) {
            $mailer->compose()->setTo($setTo)->setSubject($setSubject)->setTextBody($content)->send();
        } elseif (is_array($setTo)) {
            $message = [];
            foreach ($setTo as $user) {
                $message[] = $mailer->compose()->setTo($user)->setSubject($setSubject)->setTextBody($content);
            }
            $mailer->sendMultiple($message);
        }
        return true;
    }
}