<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');


Route::group('api/:version/pet',function(){
    Route::post('addpet', 'api/:version.Pet/CreateOrUpdatePet');
    Route::get('indexpet', 'api/:version.Adopt/getAdoptByIndex');


});

Route::group('api/:version/hotel',function(){
    Route::get('indexhotel', 'api/:version.Hotel/getHotelByLBS');
});


Route::group('api/:version/theme',function(){
    Route::get('index', 'api/:version.Theme/getIndex');
});

Route::group('api/:version/recommend',function(){
    Route::get('index', 'api/:version.Recommend/getRecommendByIndex');
});