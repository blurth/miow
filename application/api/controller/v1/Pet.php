<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\PetInfo;


class Pet extends BaseController
{

    public function CreateOrUpdatePet()
    {

        $param = input('post.');
        $uid = 2;
        $param['user_id'] = $uid;
        $data[] =$param;
        $petModel = new PetInfo();

        $res = $petModel->allowField(true)->saveAll($data);

        return $res;
    }
}