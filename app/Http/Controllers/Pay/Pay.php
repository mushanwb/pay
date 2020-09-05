<?php


namespace App\Http\Controllers\Pay;


interface Pay {

    /**
     * Pay constructor.
     * 支付配置
     * @param $config
     */
    public function __construct($config);

    /**
     * 支付参数
     * @param $payInfo
     * @return mixed
     */
    public function pay($payInfo);

}
