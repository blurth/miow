<?php


namespace app\api\model;


class Product extends BaseModel
{
   static function getRecommend(){
       return self::paginate();
   }
}