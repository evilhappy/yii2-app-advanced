<?php

namespace backend\modules\v1\user\controllers;

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
        var_dump(phpinfo());exit;
        if (Yii::$app->getRequest()->isGet) {

        } else {
            return Tools::result(700);
        }
    }

}
