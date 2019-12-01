<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Product;

class Recommend extends BaseController
{
    public function getRecommendByIndex($start=0,$count=10)
    {
        return Product::getRecommend();
    }
}