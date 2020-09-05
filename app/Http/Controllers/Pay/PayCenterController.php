<?php


namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayCenterController extends Controller {

    private static $payment = ['WechatPay','ALi'];

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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

        return true;
    }

}
