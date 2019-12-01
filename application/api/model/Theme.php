<?php


namespace app\api\model;


class Theme extends BaseModel
{
  static function getIndexData(){
      $data = self::where([])->field('id,title,name,img')->select();

      return $data;
  }
}