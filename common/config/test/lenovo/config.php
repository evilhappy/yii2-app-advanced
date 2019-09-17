<?php
return [
    'class' => 'pay\services\v1\pay\LenovoService',
    //=======【基本信息设置】=====================================
    'APP_ID' => '3022775150',
    'PUBLICKEY' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCfA7wqirQCHzSACwUiZ2k6vONruvVzSkV9wN79S73NVFNeiVHfn5d0bus03YqFdG37csN34JD83L+MEjzVErUKCm4Cou/0vuGnHgoG7aS0bdWHymH+zbHaDhRrha+a5gaA+DAAaWwusqNWWsMgnAJCICjn6oSpXWuCV48ic6Sc6wIDAQAB',//平台公钥
    'PRIVATEKEY' =>'MIICXgIBAAKBgQCYbIB/JyPVv6FMthpfC7Qtu6iuJNoIQshlPwhHdZxGrS/TkAF/KwrApTjw69rWt/RTgYXSbNabIdaOohFHC6Ex0szz5EW4gPVGiHzKCtG3Pfbl8lDdsLojrhXgaNkB3kSJtMXraNtBZpAr1SdcANt1IL3SkMFu3o9BeTX/sOJReQIDAQABAoGAda53+zQV58b/W0HR1IYtw416q5FKQUyGeh0TYFC+qpa2MUqizTNHJvupneELYfI/EmYTEyby/m0+wXsBie/BsIoIw5Mo54BDarv3IuA/iWRXhpucfly+viECBclahMGV02K+v/PCRxrtQvOXBGnQJAatHiAXxt1RGHkXjeIXZz0CQQDdSlSsfsXR6STN4e3X8gVIrNvpvSf9vCsa+36WTHDxqpjmI7/9AmfmjuoytZ1yP0M++lns6FYSmM4q8kfSmKaLAkEAsFTpj5h4FsFRjvaaVB884nA3tDN4X4WRfFw/DCDhq+oCvBheW0vw9uTEgF6W6Z2Y3JJoA4loGiffIBo/HiAsiwJBAINpq+UQF9vzT0bwf3U5JYgmFya0jTYyc4q/hUouNPhe7hPlcRMIRbl2b4ATuF9rUDzrIVH+G3dJxU1duedHfccCQQCRnm4LohR6ZkfeUpT8p5d2QMofzOm5qOqO0vdWIsl7WZPMlitGJh7nJeGJSZRDdVzJuzaexRjtkMPZFRPO4y8lAkEAxDnFOgtNwMhxtKwwUhNheXMJ/cgREzlSPiXha5+l/KM0mSXo2LDLeORCQ0IJv2/+nEE5ADFzT6IDx6AYe1F+xA==',//应用私钥
    'NOTIFY_URL' => DOMAIN_API.'/v2/pay/order/lenovo-callback',
    'UNIFIED_ORDER_URL' => 'https://cp.iapppay.com/payapi/order',
];