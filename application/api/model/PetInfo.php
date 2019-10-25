<?php


namespace app\api\model;


class PetInfo extends BaseModel
{
    static function getIndexPet($size='10'){
        return self::where('is_adopt',1)->order('create_time desc')->limit($size)->select();
    }
}