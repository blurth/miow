<?php


namespace app\api\model;


use app\lib\exception\MissException;

class Banner extends BaseModel
{
    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    static function getBannerById($id)
    {
        $banner = self::with(['items','items.img'])
            ->find($id);

        return $banner;
    }


    static function getBannerByName($name)
    {
        $banner = self::where(['name'=>$name])->with(['items','items.img'])->find();

        if (!empty($banner)){
            return $banner;
        }
        throw new MissException();
    }
}