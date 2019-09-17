<?php
return [
    'class' => 'pay\services\v1\pay\OppoService',
    //=======【基本信息设置】=====================================
    'PUBLICKEY' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCmreYIkPwVovKR8rLHWlFVw7YDfm9uQOJKL89Smt6ypXGVdrAKKl0wNYc3/jecAoPi2ylChfa2iRu5gunJyNmpWZzlCNRIau55fxGW0XEu553IiprOZcaw5OuYGlf60ga8QT6qToP0/dpiL/ZbmNUO9kUhosIjEu22uFgR+5cYyQIDAQAB',
    'NOTIFY_URL' => DOMAIN_API.'/v2/pay/order/oppo-callback',
];