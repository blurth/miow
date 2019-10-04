<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2018/12/5
 * Time: 16:23
 */

namespace app\api\service;

use think\Loader;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');
Loader::import('WxPay.WxPay', EXTEND_PATH, '.Data.php');
class Refund
{

    protected $orderNo;
    protected $refundNo;
    protected $reason;
    protected $price;
    protected $refundMoney;
    protected $merchid;

    public function __construct($orderNo,$price,$refundMoney,$reason)
    {


        $this->orderNo = $orderNo;
        $this->refundNo = 'refund_'.uniqid();
        $this->reason = $reason;
        $this->price = $price;
        $this->refundMoney = $refundMoney;
        $this->merchid = \WxPayConfig::MCHID;
    }



    public function makeWxPreRefund()
    {
        $input = new \WxPayRefund();
        $input->SetOut_trade_no($this->orderNo);       //自己的订单号
        $input->SetOut_refund_no($this->refundNo);       //退款单号
        $input->SetTotal_fee($this->price);   //订单标价金额，单位为分
        $input->SetRefund_fee($this->refundMoney);      //退款总金额，订单总金额，单位为分，只能为整数
        $input->SetRefund_desc($this->reason);
        $input->SetOp_user_id($this->merchid);

        $wxOrder = \WxPayApi::refund($input);

        if ($wxOrder === false) {
            die('parse xml error');
        }
        if ($wxOrder['return_code'] != 'SUCCESS') {
            die($wxOrder['return_msg']);
        }
        if ($wxOrder['result_code'] != 'SUCCESS') {
            die($wxOrder['err_code']);
        }

            return $wxOrder['out_refund_no'];
    }




    

}