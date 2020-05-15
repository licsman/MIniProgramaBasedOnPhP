<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//微信小程序官宣首页
Route::get('/','Admin\LoginController@index');



//微信接口
Route::group(['prefix'=>'weixin','namespace'=>'wxapi'],function(){
    Route::get('login','LoginController@wxlogin');
});

//管理员登陆

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('code','LoginController@code');
    Route::any('login','LoginController@login');
});


Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function() {
    Route::get('exit', 'LoginController@exit');
    Route::get('/', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::any('pass', 'IndexController@pass_update');

    Route::any('categoryApi','CategoryController@categoryApi');
    Route::resource('category','CategoryController');
    Route::post('cateUpdate/{cate_id}','CategoryController@cateUpdate');

    Route::resource('course','CourseController');
    Route::any('courseApi','CourseController@courseApi');
    Route::post('courseUpdate/{course_id}','CourseController@courseUpdate');
    Route::any('upload','CommonController@upload');

    Route::any('videoApi','VideoController@videoApi');
    Route::post('videoUpdate/{video_id}','VideoController@videoUpdate');
    Route::resource('video','VideoController');
    Route::any('uploadVideo','CommonController@uploadVideo');

    Route::resource('material','MaterialController');
    Route::any('materialApi','MaterialController@materialApi');
    Route::post('materialUpdate/{material_id}','MaterialController@materialUpdate');
    Route::any('imageUpload','CommonController@imageUpload');

    Route::resource('studyway','StudywayController');
    Route::any('studywayApi','StudywayController@studywayApi');
    Route::post('studywayUpdate/{studyway_id}','StudywayController@studywayUpdate');

    Route::resource('teacher','TeacherController');
    Route::any('teacherApi','TeacherController@teacherApi');
    Route::post('teacherUpdate/{teacher_id}','TeacherController@teacherUpdate');

    Route::resource('student','StudentController');
    Route::any('studentApi','StudentController@studentApi');
    Route::get('student/show','StudentController@show');
});