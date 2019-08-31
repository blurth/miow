<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/15
 * Time: 16:55
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;
}