<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\ProductCategory;

class Shop extends BaseController
{
    //获取商城首页分类宫格
    public function getCategoryList()
    {
        return ProductCategory::getShopLIst();
   }
}