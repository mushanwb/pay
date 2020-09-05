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
     */
    public function __construct($payment) {
        $this->payment = $payment;

        $this->payObjectConfig = [
            'WechatPay' => config('wechat.payment.default'),
            'ALi' => config('ali.payment.default'),
        ];

    }

    public function getPayObject() {
        $payObjectConfig = $this->payObjectConfig[$this->payment];
        switch ($this->payment) {
            case "WechatPay":
                return new WechatPayController($payObjectConfig);
            case "ALi":
                return new AliPayController($payObjectConfig);
            default:
                return null;
        }
    }

}
