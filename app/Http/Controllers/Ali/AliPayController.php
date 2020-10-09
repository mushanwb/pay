<?php

namespace App\Http\Controllers\Ali;

use App\Http\Controllers\Ali\SDK\AopClient;
use App\Http\Controllers\Ali\SDK\request\AlipayTradeAppPayRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Pay\Pay;
use Illuminate\Support\Facades\Log;

class AliPayController extends Controller implements Pay {

    protected $aliPay;
    protected $config;

    /**
     * AliPay constructor.
     * @param $config
     */
    public function __construct($config) {

        // TODO: Implement pay() method.
        $this->aliPay = new AopClient($config);
        $this->config = $config;
    }

    /**
     * @param $payInfo
     * @return bool|string
     */
    public function pay($payInfo) {

        Log::info("订单： " . $payInfo['order_num'] . "  开始支付宝支付");
        // TODO: Implement pay() method.
        $request = new AlipayTradeAppPayRequest();

        $orderNeedParam = $this->payParamProcess($payInfo);

        $bizcontent = json_encode($orderNeedParam);

        $request->setNotifyUrl($this->config['notify_url']);

        $request->setBizContent($bizcontent);

        $response = $this->aliPay->sdkExecute($request);

        Log::info("订单： " . $payInfo['order_num'] . "  支付宝支付返回结果： " . json_encode($response));

        return $response;

    }

    protected function payParamProcess($payInfo) {

        // 必传参数，不可缺少，如需格外参数，则在后面添加到数组中
        $orderNeedParam = [
            'body' => $payInfo['goods_title'],
            'timeout_express' => '30m',
            'subject' => $payInfo['detail'],
            'total_amount' => $payInfo['total_price'],
            'product_code' => 'QUICK_MSECURITY_PAY',
            'out_trade_no' => $payInfo['order_num']
        ];

        if ($payInfo['trade_type'] == "app_hua_bei") {
            $orderNeedParam['extend_params'] = array(
                'hb_fq_num' => $payInfo['period_num'],
                'hb_fq_seller_percent' => ($payInfo['hb_fq_seller_percent'] == 100) ? 100 : 0
            );
        }
        Log::info("支付参数: " . json_encode($orderNeedParam));
        return $orderNeedParam;
    }
}
