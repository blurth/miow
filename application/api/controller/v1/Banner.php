<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissException;


class Banner extends BaseController
{
    public function getBanner($id)
    {

        (new IDMustBePositiveInt())->goCheck();
        $banner = BannerModel::getBannerById($id);
        if (!$banner) {
            throw new MissException([
                'msg' => '请求banner不存在',
                'errorCode' => 40000
            ]);
        }
        return $banner;
    }

    public function getBannerByName($name)
    {

        $banner = BannerModel::getBannerByName($name);

        return $banner;
    }
}