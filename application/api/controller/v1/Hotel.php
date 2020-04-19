<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\PetHotel;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\LongitudeAndLatitude;


class Hotel extends BaseController
{
    public function getHotelByLBS($lon,$lat)
    {
        //根据坐标判断市区
        (new LongitudeAndLatitude())->goCheck();
        $district =  $this->getDistrictByCoordinate($lon,$lat);

        $hotel = PetHotel::getHotelByDistrict($district);
        $from = [$lon,$lat];

        foreach ($hotel as $k){
            $to = [$k->longitudes,$k->latitudes];
            $distance = $this->get_distance($from,$to);
            $k->distance = $distance;
        }

        usort($hotel, array($this, "cmp"));

        return $hotel;
    }

    function cmp($a, $b){return $a->distance>$b->distance;} //然后根据市区进行排序  如果区没有  就根据市排序 市没有就返回个屁




    /**
     * 根据起点坐标和终点坐标测距离
     * @param  [array]   $from 	[起点坐标(经纬度),例如:array(118.012951,36.810024)]
     * @param  [array]   $to 	[终点坐标(经纬度)]
     * @param  [bool]    $km        是否以公里为单位 false:米 true:公里(千米)
     * @param  [int]     $decimal   精度 保留小数位数
     * @return [string]  距离数值
     */
        public function get_distance($from,$to,$km=true,$decimal=2)
       {
        sort($from);
        sort($to);
        $EARTH_RADIUS = 6370.996; // 地球半径系数

        $distance = $EARTH_RADIUS*2*asin(sqrt(pow(sin( ($from[0]*pi()/180-$to[0]*pi()/180)/2),2)+cos($from[0]*pi()/180)*cos($to[0]*pi()/180)* pow(sin( ($from[1]*pi()/180-$to[1]*pi()/180)/2),2)))*1000;

        if($km){
            $distance = $distance / 1000;
       }

        return round($distance, $decimal);
    }

    //根据坐标判断市区
    public function getDistrictByCoordinate($lon,$lat)
    {
        return '莲湖区';
    }


    public function getHotelDetailById($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $data = PetHotel::getDetail($id);
        return $data;





    }
}