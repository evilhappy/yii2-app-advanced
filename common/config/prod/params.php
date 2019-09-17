<?php
return [
	//注册赠送优惠券ID
	'CouponID' => 13,
	'MyStoryShareNum' => 3,
	'RobotUrls' => [
		'https://oapi.dingtalk.com/robot/send?access_token=56c7735868ce29c398c31cd3bf22b48c37aa646eb38da4210e276e3be8aca73e',
		'https://oapi.dingtalk.com/robot/send?access_token=e0f09af682e4c06305103c2e431eec69bf7327f07661a8d3c234b02301e46f43'
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
        3=>['PAY_TEMPLATE_ID' => 'a1IE6aE2OUWrrBv4TLOyxrcen2Dxhwpzm9gObiwXHTA','PAY_GROUP_TEMPLATE_ID'=> 'QGS4sm9Vah7qRTe1EP3IeGBycswuC0XorOjGajxtHck'],
    ],
    //分销佣金级别
    'SpreadRule' => [
        ['l' => 1, 'r' => 5, 't' => 1, 'reward' => 0],
        ['l' => 6, 'r' => 30, 't' => 2, 'reward' => 1],
        ['l' => 31, 'r' => 50, 't' => 3, 'reward' => 2],
        ['l' => 51, 'r' => 1000000, 't' => 4, 'reward' => 3]
    ],
    "DingDingUrl"=>'https://oapi.dingtalk.com/robot/send?access_token=f51433b0f29543be3c94f39c4b8575377eac07d5591cad185bca984ca365c574',
];
