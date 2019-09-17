<?php

namespace frontend\modules\v1\user\controllers;

use Yii;
use backend\controllers\BaseController;
use common\libs\Tools;

class UserController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 用户列表
     */
    public function actionList()
    {
        if (Yii::$app->getRequest()->isGet) {
            return Tools::result(200);
        } else {
            return Tools::result(700);
        }
    }

}
