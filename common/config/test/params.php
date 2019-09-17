<?php
return [
	//注册赠送优惠券ID
	'CouponID' => 13,
	'MyStoryShareNum' => 3,
    'RobotUrls' => [
        'https://oapi.dingtalk.com/robot/send?access_token=e2f6b6181ff63adca7b7142a892ef4bc8d9702deaf5f1d95550b2feabd3d8b86',
    ],
	'Experiencetime' => 365,
	'TaskShareNum' => 1,
	'LimitDate' => 3,
    // 学习计划boss奖励配置
    'boss_stars' => [
        1 => [  // 21天计划
            7=>10,
            14=>50,
        ],
        2 => [ // 9天计划
            3=>5,
            7=>10,
        ]
    ],
    // 双11版本用户送券
    'GiftCoupns' => [
        1 => [27], //老用户券ID
        2 => [16], // 新用户券ID
    ],
    //微信模板消息ID
    'WechatPayTemplate' => [
        2=>['PAY_TEMPLATE_ID' => 'P9EtsPe3VYpc7rBAQpb1MhtRfJ6051tPnA8pYbcyypg','PAY_GROUP_TEMPLATE_ID'=> 'zHwTjKk9Mr58ANHNboCss-VLXTMpaokKQtt2IFE9s-E'],
        3=>['PAY_TEMPLATE_ID' => 'jiL1Igss__IClwm_XT-CJrSHZT6ioBcdGFB8iGVYlCs','PAY_GROUP_TEMPLATE_ID'=> 'w7NgWIbFkTk28_9sSrYQ_K185MFBCuWKip1ziiB5VA0'],
    ],
    //分销佣金级别
    'SpreadRule' => [
        ['l' => 1, 'r' => 2, 't' => 1, 'reward' => 0],
        ['l' => 3, 'r' => 4, 't' => 2, 'reward' => 1],
        ['l' => 5, 'r' => 6, 't' => 3, 'reward' => 2],
        ['l' => 7, 'r' => 1000000, 't' => 4, 'reward' => 3]
    ],
    "DingDingUrl"=>'https://oapi.dingtalk.com/robot/send?access_token=f51433b0f29543be3c94f39c4b8575377eac07d5591cad185bca984ca365c574',
];
