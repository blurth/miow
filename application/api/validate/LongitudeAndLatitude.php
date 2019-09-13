<?php


namespace app\api\validate;


class LongitudeAndLatitude extends BaseValidate
{
    protected $rule = [
        'lon' => 'require|float',
        'lat' => 'require|float'
    ];
}