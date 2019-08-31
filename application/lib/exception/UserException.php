<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/16
 * Time: 16:00
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}