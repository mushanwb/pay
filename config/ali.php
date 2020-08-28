<?php

return [

    /*
     * 支付宝支付
     */
    'payment' => [
        'default' => [
            'alipay_appid'                 => env('ALIPAY_APPID'),
            'alipay_private_key'           => env('ALIPAY_PRIVATE_KEY'),
            'alipay_public_key'            => env('ALIPAY_PUBLIC_KEY'),
        ],
        // ...
    ],


];
