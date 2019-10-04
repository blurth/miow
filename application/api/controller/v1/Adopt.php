<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\PetInfo;

class Adopt extends BaseController
{
    public function getAdoptByIndex()
    {
        $res = PetInfo::getIndexPet();

        if (!empty($res)){
            return $res;
        }
    }
}