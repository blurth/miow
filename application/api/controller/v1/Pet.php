<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\PetInfo;


class Pet extends BaseController
{

    /**
     * 更新或创建宠物
     * @author user
     * @param  array
     * @return bool
     */
    public function CreateOrUpdatePet()
    {

        $data = input('post.');
        $petModel = new PetInfo();

    if (isset($data['id']) && $data['id']){
        $res = $petModel->allowField(true)->save($data,$data['id']);
    }else{
        $res = $petModel->allowField(true)->save($data);
    }

        return $res;
    }
}