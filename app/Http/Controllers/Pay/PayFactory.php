<?php


namespace App\Http\Controllers\Pay;


use App\Http\Controllers\Ali\AliPayController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\WechatPayController;

class PayFactory extends Controller {

    private $payment;
    private $payObjectConfig;

    /**
     * PayFactory constructor.
     * 支付方式
     * @param $payment
     * @param $tradeType
     */
    public function __construct($payment, $tradeType) {
        $this->payment = $payment;

        // 支付配置路径
        $configStr = strtolower($payment) . ".payment." . $tradeType;
        $config = config($configStr);

        // 支付配置中的默认配置参数名称
        $defaultConfig = strtoupper($tradeType) . "_" . strtoupper($payment) . "_DEFAULT";
        // 如果配置中的默认选项为 true，则配置选默认配置
        if ($config[$defaultConfig]) {
            $configStr = strtolower($payment) . ".payment.default";
            $config = config($configStr);
        }

        $this->payObjectConfig = $config;
    }

    public function getPayObject() {
        switch ($this->payment) {
            case "WechatPay":
                return new WechatPayController($this->payObjectConfig);
            case "AliPay":
                return new AliPayController($this->payObjectConfig);
            default:
                return null;
        }
    }


}


