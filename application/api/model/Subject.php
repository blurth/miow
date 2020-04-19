<?php


namespace app\api\model;


class Subject extends BaseModel
{
    public function product()
    {
        return $this->belongsToMany('product','product_subject','product_id','subject_id');
    }


    public function getMainImgUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }


   static function getSubjectByName($name){
      return self::where(['name'=>$name])->find();
   }
}