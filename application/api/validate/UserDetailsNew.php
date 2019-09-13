<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/10/28
 * Time: 11:12
 */

namespace app\api\validate;


class UserDetailsNew extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
    ];
}