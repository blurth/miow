<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2018/3/29
 * Time: 14:45
 */

namespace app\lib\exception;


class DiaryException extends BaseException
{
    public $code = 404;
    public $msg = '指定日记不存在，请检查日记ID';
    public $errorCode = 20000;
}