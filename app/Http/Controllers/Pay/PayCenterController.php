<?php


namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayCenterController extends Controller {

    private static $payment = ['WechatPay','ALi'];

    private static $payObjectNameSpace = [
        'WechatPay' => 'App\Http\Controllers\Wechat\WechatPayController',
        'ALi' => 'App\Http\Controllers\Ali\AliPayController',
    ];

    private $payObjectConfig;

    /**
     * PayCenter constructor.
     */
    public function __construct() {
        $this->payObjectConfig = [
            'WechatPay' => config('wechat.payment.default'),
            'ALi' => config('ali.payment.default'),
        ];
    }

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

        $payObject = $this->getPayObject($payInfo['payment']);

        $result = $payObject->pay($payInfo);

        $data['order_num'] = $payInfo['order_num'];
        $data['payment'] = $payInfo['payment'];
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

    /**
     * @param $payment
     * @return object
     */
    protected function getPayObject($payment) {

        $payObjectNameSpace = self::$payObjectNameSpace[$payment];

        $config = $this->payObjectConfig[$payment];

        Log::info("获取支付对象： " . $payObjectNameSpace . "   以及支付配置：" . json_encode($config));

        return new $payObjectNameSpace($config);
    }

}
