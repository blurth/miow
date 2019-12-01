<?php


namespace app\api\controller\v1;

use app\api\model\Theme as ThemeModel;
use app\api\controller\BaseController;

class Theme extends BaseController
{
    public function getIndex()
    {
        $res = ThemeModel::getIndexData();

        return $res;

   }
}