<?php


namespace app\api\controller\v1;


use app\lib\exception\TokenException;
use think\Controller;

class Banner extends Controller
{
    public function getBannerById()
    {

       throw new TokenException();
    }
}