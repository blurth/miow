<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/28
 * Time: 14:38
 */

namespace app\api\validate;


class AdminNew extends BaseValidate
{
    protected $rule = [
        'app_id' => 'require|isNotEmpty',
        'app_secret' => 'require|isNotEmpty',
        'scope' => 'require|isNotEmpty',
        'scope_description' => 'require|isNotEmpty',
        'tel' => 'require|isMobile',
        'address' => 'require|isNotEmpty',
    ];
}

