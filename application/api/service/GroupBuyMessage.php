<?php
/**
 * Date: 2017/3/7
 * Time: 13:27
 */

namespace app\api\service;


use app\api\model\User;
use app\lib\exception\OrderException;

class GroupBuyMessage extends WxMessage
{
    const PtSuccess_MSG_ID = 'Rbi8GFU0t4my6AsN4XoTCsShHEV1YrmtviQltsy14LY';// 小程序模板消息ID号

    //    private $productName;
    //    private $devliveryTime;
    //    private $order

    public function sendGroupBuyMessage($order, $tplJumpPage = '')
    {
        if (!$order) {
            throw new OrderException();
        }
        $this->tplID = self::PtSuccess_MSG_ID;
        $this->formID = $order->prepay_id;
        $this->page = $tplJumpPage;
        $this->prepareMessageData($order);
        return parent::sendMessage($this->getUserOpenID($order->user_id));
    }

    private function prepareMessageData($order)
    {
        $dt = new \DateTime();
        $data = [
            'keyword1' => [
                'value' => $order->order_no,
            ],
            'keyword2' => [
                'value' => $order->snap_name,
                'color' => '#27408B'
            ],
            'keyword3' => [
                'value' => $order->total_price
            ],
            'keyword4' => [
                'value' => $dt->format("Y-m-d H:i")
            ]
        ];
        $this->data = $data;
    }

    private function getUserOpenID($uid)
    {
        $user = User::get($uid);
        if (!$user) {
            throw new UserException();
        }
        return $user->openid;
    }
}