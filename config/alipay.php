<?php

return [

    /*
     * 支付宝支付
     */
    'payment' => [
        'default' => [
            'alipay_appid'                 => env('DEFAULT_ALIPAY_APPID'),
            'alipay_private_key'           => env('DEFAULT_ALIPAY_PRIVATE_KEY'),    //'请填写开发者私钥去头去尾去回车，一行字符串' ;
            'alipay_public_key'            => env('DEFAULT_ALIPAY_PUBLIC_KEY'),     //'请填写支付宝公钥，一行字符串';
            'notify_url'                   => env('DEFAULT_ALIPAY_NOTIFY_URL', ''),                           // 支付结果通知地址
        ],

        // ...
        'app' => [
            'alipay_appid'                 => env('APP_ALIPAY_APPID'),
            'alipay_private_key'           => env('APP_ALIPAY_PRIVATE_KEY'),    //'请填写开发者私钥去头去尾去回车，一行字符串' ;
            'alipay_public_key'            => env('APP_ALIPAY_PUBLIC_KEY'),     //'请填写支付宝公钥，一行字符串';
            'notify_url'                   => env('APP_ALIPAY_NOTIFY_URL', ''),                           // 支付结果通知地址
            'default'                      => env('APP_ALIPAY_DEFAULT', false)         // 是否使用默认配置
        ],

        'app_hua_bei' => [
            'alipay_appid'                 => env('APP_HUA_BEI_ALIPAY_APPID'),
            'alipay_private_key'           => env('APP_HUA_BEI_ALIPAY_PRIVATE_KEY'),    //'请填写开发者私钥去头去尾去回车，一行字符串' ;
            'alipay_public_key'            => env('APP_HUA_BEI_ALIPAY_PUBLIC_KEY'),     //'请填写支付宝公钥，一行字符串';
            'notify_url'                   => env('APP_HUA_BEI_ALIPAY_NOTIFY_URL', ''),                           // 支付结果通知地址
            'default'                      => env('APP_HUA_BEI_ALIPAYDEFAULT', false)         // 是否使用默认配置
        ],
    ],


];
