<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/16
 * Time: 15:58
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}