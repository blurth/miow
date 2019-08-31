<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/13
 * Time: 9:22
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $errorCode = 10000;
    public $msg = "invalid parameters";
}