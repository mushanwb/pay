<?php


namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pay\Pay;
use EasyWeChat\Factory;
use Illuminate\Support\Facades\Log;

class WechatPayController extends Controller implements Pay {

    protected $wechatPay;

    /**
     * WechatPay constructor.
     * @param $config
     */
    public function __construct($config) {

        // TODO: Implement pay() method.
        $this->wechatPay = Factory::payment($config);
    }

    /**
     * @param $payInfo
     * @return array|bool|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pay($payInfo) {
        Log::info("订单： " . $payInfo['order_num'] . "  开始微信支付");

        // TODO: Implement pay() method.

        $orderInfo = $this->payParamProcess($payInfo);

        $payResult = $this->wechatPay->order->unify($orderInfo);

        Log::info("订单： " . $payInfo['order_num'] . "  微信支付返回结果： " . json_encode($payResult));

        if ($payResult['return_code'] == 'SUCCESS' && $payResult['result_code'] == 'SUCCESS') {
            return $this->wechatPay->jssdk->bridgeConfig($payResult['prepay_id'], false);
        } else {
            Log::error("订单： " . $payInfo['order_num'] . "  微信支付失败");
            return false;
        }

    }

    protected function payParamProcess($payInfo) {

        // 必传参数，不可缺少，如需格外参数，则在后面添加到数组中
        $orderNeedParam = [
            'body' => $payInfo['goods_title'],
            'detail' => $payInfo['detail'],
            'out_trade_no' => $payInfo['order_num'],
            'total_fee' => bcmul($payInfo['total_price'], 100),
            'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
            'openid' => $payInfo['openid'],
        ];

        return $orderNeedParam;
    }

}
