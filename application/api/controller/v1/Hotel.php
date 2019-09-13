<?php


namespace app\api\controller\v1;


use app\api\validate\LongitudeAndLatitude;
use think\Controller;

class Hotel extends Controller
{
    public function getHotelByLBS($lon,$lat)
    {
        (new LongitudeAndLatitude())->goCheck();

        return 123;
    }
}