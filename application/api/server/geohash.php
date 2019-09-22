<?php


namespace app\api\server;


/**
 *
 *
 * @desc 地理位置信息
 */
class Location
{
    // 地球的求半径，单位还是m
    const EARTH_RADIUS = 6378137;

    /**
     * 经纬度转化为幅度
     * @param string $d
     * @return number
     */
    private static function fnRad($d)
    {
        return $d * pi() / 180.0;
    }

    /**
     * 计算两点之间的距离，单位m
     * latitude(-90,90)
     * longitude(-180,180)
     * @param string $lnglat1
     * @param string $lnglat2
     */
    public static function getP2PDistance($srcLongLat, $destLongLat)
    {
        $srcLongLat = explode(',', $srcLongLat);
        $destLongLat = explode(',', $destLongLat);
        list($lat1, $lng1) = $srcLongLat;
        list($lat2, $lng2) = $destLongLat;

        //return self::googleDistance($lat1, $lng1, $lat2, $lng2);
        return self::selfDistance($lat1, $lng1, $lat2, $lng2);
    }

    /**
     * 自定义算法
     * 效率更高
     */
    private static function selfDistance($lat1, $lng1, $lat2, $lng2)
    {
        //将角度转为狐度
        $radLat1 = deg2rad($lat1);
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        //结果
        $s = acos(cos($radLat1)*cos($radLat2)*cos($radLng1-$radLng2)+sin($radLat1)*sin($radLat2))*self::EARTH_RADIUS;
        //精度
        $s = round($s* 10000)/10000;

        return  round($s);
    }

    /**
     * google的算法
     * 效率稍微差一点
     */
    private static function googleDistance($lat1, $lng1, $lat2, $lng2)
    {
        // 通过纬度取得对应的幅度
        $srcRadLat = self::fnRad($lat1);
        $destRadLat = self::fnRad($lat2);

        // 获取两点纬度弧度差
        $a = $srcRadLat - $destRadLat;
        // 获取两点经度的弧度差
        $b = self::fnRad($lng1) - self::fnRad($lng2);

        // 计算球体上该弧度对应的距离
        $s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($srcRadLat)*cos($destRadLat)*pow(sin($b/2),2))) * self::EARTH_RADIUS;
        // 取得距离的km数
        $s = round($s * 10000) / 10000;

        return round($s);
    }
}
