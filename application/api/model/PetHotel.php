<?php


namespace app\api\model;


class PetHotel extends BaseModel
{
      static function getHotelByDistrict($district){
          $res = self::where('district','=',$district)->select();
          return $res;
      }
}