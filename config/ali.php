<?php

return [

    /*
     * 支付宝支付
     */
    'payment' => [
        'default' => [
            'alipay_appid'                 => env('ALIPAY_APPID'),
            'alipay_private_key'           => env('ALIPAY_PRIVATE_KEY'),    //'请填写开发者私钥去头去尾去回车，一行字符串' ;
            'alipay_public_key'            => env('ALIPAY_PUBLIC_KEY'),     //'请填写支付宝公钥，一行字符串';
        ],
        // ...
    ],


];
