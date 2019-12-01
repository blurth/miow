<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\PetInfo;
use app\lib\exception\MissException;

class Adopt extends BaseController
{
    /*
     * 获取领养宠物 默认10条
     * */
    public function getAdoptByIndex()
    {

        $res = PetInfo::getIndexPet();

        if (empty($res)){
            throw new MissException(['msg'=>'数据不存在']);
        }

        return $res;
    }




}