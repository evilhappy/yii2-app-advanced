<?php
header("Access-Control-Allow-Origin: *");

require(__DIR__ . '/../../common/config/base.php');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/'.YII_ENV.'/main.php',
    require __DIR__ . '/../config/main.php'
);

(new yii\web\Application($config))->run();
