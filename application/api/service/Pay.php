<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/26
 * Time: 16:02
 */

namespace app\api\service;


use app\api\model\Order as OrderModel;
use app\api\service\Order;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use think\Loader;
use think\Log;

//Loader::import('WxPay.WxPay', EXTEND_PATH, '.Data.php');
Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');
Loader::import('WxPay.WxPay', EXTEND_PATH, '.Data.php');

class Pay
{
    private $orderNo;
    private $orderID;
//    private $orderModel;

    function __construct($orderID)
    {
        if (!$orderID)
        {
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;
    }

    public function pay()
    {
        $this->checkOrderValid();
        $order = new Order();
        $status = $order->checkOrderStock($this->orderID);
        if (!$status['pass'])
        {
            return $status;
        }
        return $this->makeWxPreOrder($status['orderPrice']);
        //        $this->checkProductStock();
    }

    /**
     * 拼团支付
     *
     */
    public function ptPay()
    {
        $this->checkOrderValid();
        $order = new Order();
        $status = $order->checkCutOrderStock($this->orderID);

        if (!$status['pass'])
        {
            return $status;
        }
        return $this->makeWxPreOrder($status['orderPrice']);
        //        $this->checkProductStock();
    }




    public function payCut()
    {
        $this->checkOrderValid();
        $order = new Order();
        $status = $order->checkCutOrderStock($this->orderID);
        if (!$status['pass'])
        {
            return $status;
        }
        return $this->makeWxPreOrder($status['orderPrice']);
        //        $this->checkProductStock();
    }

    // 构建微信支付订单信息
    private function makeWxPreOrder($totalPrice)
    {
        $openid = Token::getCurrentTokenVar('openid');

        if (!$openid)
        {
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNo);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($totalPrice * 100);
        $wxOrderData->SetBody('西安悦华');
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url(config('secure.pay_back_url'));

        return $this->getPaySignature($wxOrderData);
    }

    //向微信请求订单号并生成签名
    private function getPaySignature($wxOrderData)
    {
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        // 失败时不会返回result_code
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
//            throw new Exception('获取预支付订单失败');
        }
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    private function recordPreOrder($wxOrder){
        // 必须是update，每次用户取消支付后再次对同一订单支付，prepay_id是不同的
        OrderModel::where('id', '=', $this->orderID)
            ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }

    // 签名
    private function sign($wxOrder)
    {
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());
        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');
        $sign = $jsApiPayData->MakeSign();
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        unset($rawValues['appId']);
        return $rawValues;
    }

    /**
     * @return bool
     * @throws OrderException
     * @throws TokenException
     */
    private function checkOrderValid()
    {
        $order = OrderModel::where('id', '=', $this->orderID)
            ->find();
        if (!$order)
        {
            throw new OrderException();
        }
//        $currentUid = Token::getCurrentUid();
        if(!Token::isValidOperate($order->user_id))
        {
            throw new TokenException(
                [
                    'msg' => '订单与用户不匹配',
                    'errorCode' => 10003
                ]);
        }
        if($order->status != 1){
            throw new OrderException([
                'msg' => '订单已支付过啦',
                 'errorCode' => 80003,
                'code' => 400
            ]);
        }
        $this->orderNo = $order->order_no;
        return true;
    }

    /**
     * 退款
     * */
    public static function payBack($order_id)
    {

        $order = OrderModel::get($order_id);

        $orderNo = $order->order_no;//商户订单号（商户订单号与微信订单号二选一，至少填一个）
        $totalPrice = $order->total_price;
        $mchid = '1491270292';          //微信支付商户号 PartnerID 通过微信支付商户资料审核后邮件发送
        $appid = 'wxe0155e2914a4ad6c';  //微信支付申请对应的公众号的APPID
        $apiKey = 'sfsgdsg6546FGG65G65d4fh64654dg1e';   //https://pay.weixin.qq.com 帐户设置-安全设置-API安全-API密钥-设置API密钥
        $wxOrderNo = '';                     //微信订单号（商户订单号与微信订单号二选一，至少填一个）
        $totalFee = $totalPrice;                   //订单金额，单位:元
        $refundFee = $totalPrice;                  //退款金额，单位:元
        $refundNo = 'refund_'.uniqid();        //退款订单号(可随机生成)
        $wxPay = new WxPabackRefund($mchid,$appid,$apiKey);
        $result = $wxPay->doRefund($totalFee, $refundFee, $refundNo, $wxOrderNo,$orderNo);

        if ($result){
            $order->save(['status'  => 5]);

            return $refundNo;
        }
        return false;

    }

}