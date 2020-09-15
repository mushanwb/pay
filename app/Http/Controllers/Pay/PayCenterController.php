<?php


namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\WechatPayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayCenterController extends Controller {

    private static $payment = ['WechatPay','ALiPay'];

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

        $payFactory = new PayFactory($payment);

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
        $payNeedParam = ['goods_title', 'detail', 'total_price', 'order_num', 'payment'];

        $payInfoKey = array_keys($payInfo);

        if (array_diff($payNeedParam, $payInfoKey) || !in_array($payInfo['payment'], self::$payment)) {
            return false;
        }

        if ($payInfo['payment'] == "WechatPay" && !$this->wechatPayNeedParam($payInfoKey, $payInfo)) {
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
        if (!in_array("openid", $payInfoKey) || !in_array("trade_type", $payInfoKey)) {
            return false;
        };

        if (!in_array($payInfo['trade_type'], WechatPayController::$wechat_trade_type)) {
            return false;
        }

        return true;
    }

}
