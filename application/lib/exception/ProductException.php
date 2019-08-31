<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/15
 * Time: 10:17
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '指定商品不存在，请检查商品ID';
    public $errorCode = 20000;
}