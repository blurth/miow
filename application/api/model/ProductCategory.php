<?php


namespace app\api\model;


class ProductCategory extends BaseModel
{
static function getShopLIst(){
    $data = self::where(['parent_id'=>1])->select();

    if (!empty($data)){
        return $data;
    }
    return [];
}
}