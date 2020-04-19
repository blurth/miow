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


//轮播图
Route::group('api/:version/banner',function(){
    Route::get('by_name', 'api/:version.Banner/getBannerByName');
    Route::get(':id', 'api/:version.Banner/getBanner');
});

//shop 商城
Route::group('api/:version/shop',function(){
    Route::get('grid', 'api/:version.Shop/getCategoryList');

});

//宠物相关
Route::group('api/:version/pet',function(){
    Route::post('addpet', 'api/:version.Pet/CreateOrUpdatePet');
    Route::get('indexpet', 'api/:version.Adopt/getAdoptByIndex');
});
//家庭
Route::group('api/:version/hotel',function(){
    Route::get('indexhotel', 'api/:version.Hotel/getHotelByLBS');
    Route::get('detail', 'api/:version.Hotel/getHotelDetailById');
});

//gong相关
Route::group('api/:version/theme',function(){
    Route::get('index', 'api/:version.Theme/getIndex');
});


//专题相关
Route::group('api/:version/subject',function(){
    Route::get(':name', 'api/:version.Subject/getSubjectByName');
});

Route::group('api/:version/recommend',function(){
    Route::get('index', 'api/:version.Recommend/getRecommendByIndex');
});