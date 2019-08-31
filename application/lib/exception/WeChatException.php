<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/15
 * Time: 15:21
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = 'wechat unknown error';
    public $errorCode = 999;
}