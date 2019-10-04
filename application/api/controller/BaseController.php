<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/10/25
 * Time: 14:10
 */

namespace app\api\controller;


use think\Controller;
use app\api\service\Token;
use think\Request;

class BaseController extends Controller
{

protected function _initialize()
{
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: *');
}

    protected function checkExclusiveScope()
    {
        Token::needExclusiveScope();
    }

    protected function checkPrimaryScope()
    {
        Token::needPrimaryScope();
    }

    protected function checkSuperScope()
    {
        Token::needSuperScope();
    }

    protected function checkSalesmanScope()
    {
        Token::needSalesmanScope();
    }

}