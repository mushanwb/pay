<?php


namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\WechatPayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayCenterController extends Controller {

    private static $payment = ['WechatPay','AliPay'];
    private static $wechatTradeType = ['app', 'web', 'mini_program'];
    private static $aliTradeType = ['app', 'app_hua_bei'];


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function payCenter(Request $request) {
        Log::info("开始支付流程");

        $payInfo = $request->all();

        if (!$this->payNeedParamVerification($payInfo)) {
            return $this->_apiExit(40001);
        }

        $payment = $payInfo['payment'];
        $tradeType = $payInfo['trade_type'];

        $payFactory = new PayFactory($payment, $tradeType);

        $payObject = $payFactory->getPayObject();

        if ($payObject == null) {
            return $this->_apiExit(40002);
        }

        $result = $payObject->pay($payInfo);

        $data['order_num'] = $payInfo['order_num'];
        $data['payment'] = $payment;
        $data['pay_param'] = $result;

        if ($result) {
            return $this->_apiExit(200,$data);
        } else {
            return $this->_apiExit(50001);
        }

    }

    /**
     * @param $payInfo
     * @return bool
     */
    protected function payNeedParamVerification($payInfo) {
        $payNeedParam = ['goods_title', 'detail', 'total_price', 'order_num', 'payment', 'trade_type'];

        $payInfoKey = array_keys($payInfo);

        if (array_diff($payNeedParam, $payInfoKey) || !in_array($payInfo['payment'], self::$payment)) {
            return false;
        }

        if ($payInfo['payment'] == "WechatPay" && !$this->wechatPayNeedParam($payInfoKey, $payInfo)) {
            return false;
        }

        if ($payInfo['payment'] == "AliPay" && !$this->aliPayNeedParam($payInfo)) {
            return false;
        }

        return true;
    }

    /**
     * 微信支付需要传的参数
     * @param $payInfoKey
     * @param $payInfo
     * @return bool
     */
    protected function wechatPayNeedParam($payInfoKey, $payInfo) {
        if (!in_array("openid", $payInfoKey)) {
            return false;
        };

        if (!in_array($payInfo['trade_type'], self::$wechatTradeType)) {
            return false;
        }

        return true;
    }

    /**
     * 支付宝支付需要参数
     * @param $payInfoKey
     * @param $payInfo
     * @return bool
     */
    protected function aliPayNeedParam($payInfoKey, $payInfo) {
        if (!in_array($payInfo['trade_type'], self::$aliTradeType)) {
            return false;
        }

        if ($payInfo['trade_type'] == "app_hua_bei" && (
            !in_array("period_num", $payInfoKey) ||
            !in_array("hb_fq_seller_percent", $payInfoKey))) {
            return false;
        }

        return true;
    }
}
