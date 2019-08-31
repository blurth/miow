<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/18
 * Time: 16:43
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '指定类目不存在，请检查商品ID';
    public $errorCode = 20000;
}