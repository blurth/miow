<?php


namespace app\api\model;


class PetHotel extends BaseModel
{
      static function getHotelByDistrict($district){
          $res = self::where('district','=',$district)->select();
          return $res;
      }

    public function getMainImgUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }

    static function getDetail($id){
          $detail = self::where(['id'=>$id,'status'=>2])->find();

          $banner = Banner::getBannerById($detail['banner_id']);

          $res = [];
          $res['banner'] = $banner['items'];
          $res['detail'] = $detail;
        return $res;

    }

}