<?php

return [

    /*
     * 微信支付
     */
    'payment' => [
        'default' => [
            'sandbox'            => env('DEFAULT_WECHAT_PAYMENT_SANDBOX', false),      // true 为开启沙箱模式
            'app_id'             => env('DEFAULT_WECHAT_PAYMENT_APPID', ''),
            'mch_id'             => env('DEFAULT_WECHAT_PAYMENT_MCH_ID', 'your-mch-id'),
            'key'                => env('DEFAULT_WECHAT_PAYMENT_KEY', 'key-for-signature'),
//            'cert_path'          => app_path('cert/apiclient_cert.pem'),    // XXX: 绝对路径！！！！如果不发红包等活动的话是不需要证书的，具体限制看官网文档
//            'key_path'           => app_path('cert/apiclient_key.pem'),      // XXX: 绝对路径！！！！如果不发红包等活动的话是不需要证书的，具体限制看官网文档
            'notify_url'         => env('DEFAULT_WECHAT_NOTIFY_URL', ''),                           // 支付结果通知地址
        ],
        // ...

        'app' => [
            'sandbox'            => env('APP_WECHAT_PAYMENT_SANDBOX', false),      // true 为开启沙箱模式
            'app_id'             => env('APP_WECHAT_PAYMENT_APPID', ''),
            'mch_id'             => env('APP_WECHAT_PAYMENT_MCH_ID', 'your-mch-id'),
            'key'                => env('APP_WECHAT_PAYMENT_KEY', 'key-for-signature'),
//            'cert_path'          => app_path('cert/apiclient_cert.pem'),    // XXX: 绝对路径！！！！如果不发红包等活动的话是不需要证书的，具体限制看官网文档
//            'key_path'           => app_path('cert/apiclient_key.pem'),      // XXX: 绝对路径！！！！如果不发红包等活动的话是不需要证书的，具体限制看官网文档
            'notify_url'         => env('APP_WECHAT_NOTIFY_URL', ''),                           // 支付结果通知地址
            'default'            => env('APP_WECHAT_DEFAULT', false)         // 是否使用默认配置
        ],

        'web' => [
            'sandbox'            => env('WEB_WECHAT_PAYMENT_SANDBOX', false),      // true 为开启沙箱模式
            'app_id'             => env('WEB_WECHAT_PAYMENT_APPID', ''),
            'mch_id'             => env('WEB_WECHAT_PAYMENT_MCH_ID', 'your-mch-id'),
            'key'                => env('WEB_WECHAT_PAYMENT_KEY', 'key-for-signature'),
//            'cert_path'          => app_path('cert/apiclient_cert.pem'),    // XXX: 绝对路径！！！！如果不发红包等活动的话是不需要证书的，具体限制看官网文档
//            'key_path'           => app_path('cert/apiclient_key.pem'),      // XXX: 绝对路径！！！！如果不发红包等活动的话是不需要证书的，具体限制看官网文档
            'notify_url'         => env('WEB_WECHAT_NOTIFY_URL', ''),                           // 支付结果通知地址
            'default'            => env('WEB_WECHAT_DEFAULT', false)         // 是否使用默认配置
        ],

        'mini_program' => [
            'sandbox'            => env('MINI_PROGRAM_WECHAT_PAYMENT_SANDBOX', false),      // true 为开启沙箱模式
            'app_id'             => env('MINI_PROGRAM_WECHAT_PAYMENT_APPID', ''),
            'mch_id'             => env('MINI_PROGRAM_WECHAT_PAYMENT_MCH_ID', 'your-mch-id'),
            'key'                => env('MINI_PROGRAM_WECHAT_PAYMENT_KEY', 'key-for-signature'),
//            'cert_path'          => app_path('cert/apiclient_cert.pem'),    // XXX: 绝对路径！！！！如果不发红包等活动的话是不需要证书的，具体限制看官网文档
//            'key_path'           => app_path('cert/apiclient_key.pem'),      // XXX: 绝对路径！！！！如果不发红包等活动的话是不需要证书的，具体限制看官网文档
            'notify_url'         => env('MINI_PROGRAM_WECHAT_NOTIFY_URL', ''),    // 支付结果通知地址
            'default'            => env('MINI_PROGRAM_WECHAT_DEFAULT', false)         // 是否使用默认配置
        ],
    ],

];
