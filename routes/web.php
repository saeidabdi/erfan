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


Route::get('/','HomeController@index');
Route::get('/home','HomeController@home');
Route::get('/getuser','HomeController@getuser');
// ---------- user
Route::post('/getimg_user','UserController@getimg_user');
Route::post('/save_profile','UserController@save_profile');
Route::post('/getmail','UserController@getmail');
Route::post('/getaddr','UserController@getaddr');
Route::post('/getmobile','UserController@getmobile');
Route::get('/exit_user','UserController@exit_user');
Route::get('/profile','UserController@profile');
Route::post('/check_username','UserController@check_username');
Route::post('/register','UserController@register');
Route::post('/login','UserController@login');
Route::get('/add_order','UserController@add_order');
Route::get('/get_cat','UserController@get_cat');
Route::post('/create_order','UserController@create_order');
Route::get('/allorder','UserController@allorder');
Route::post('/get_allorder','UserController@get_allorder');
Route::post('/delete_order','UserController@delete_order');
Route::post('/get_inorder','UserController@get_inorder');
Route::post('/get_user_orders','UserController@get_user_orders');
Route::get('/all_orders_user','UserController@all_orders_user');
Route::get('/end_orders_user','UserController@end_orders_user');
Route::get('/pay_order/{id}','UserController@pay_order');
Route::get('/buyback','UserController@buyback');
// -------- admin
Route::group(['prefix'=>'admin'],function(){

    Route::get('/index','AdminController@index');
    Route::get('/cat','AdminController@cat');
    Route::post('/add_cat','AdminController@add_cat');
    Route::get('/get_cat','AdminController@get_cat');
    Route::post('/delete_cat','AdminController@delete_cat');
    Route::get('/sizes','AdminController@sizes');
    Route::post('/add_size','AdminController@add_size');
    Route::get('/get_size','AdminController@get_size');
    Route::post('/delete_size','AdminController@delete_size');
    Route::get('/counts','AdminController@counts');
    Route::post('/add_count','AdminController@add_count');
    Route::get('/get_count','AdminController@get_count');
    Route::post('/delete_count','AdminController@delete_count');
    Route::get('/attr','AdminController@attr');
    Route::post('/add_attr','AdminController@add_attr');
    Route::get('/get_attr','AdminController@get_attr');
    Route::post('/update_attr','AdminController@update_attr');
    Route::get('/files_type','AdminController@files_type');
    Route::post('/add_files_type','AdminController@add_files_type');
    Route::get('/get_type_file','AdminController@get_type_file');
    Route::post('/add_files_type','AdminController@add_files_type');
    Route::post('/delete_type_file','AdminController@delete_type_file');
    Route::get('/orders','AdminController@orders');
    Route::get('/get_adminorder','AdminController@get_adminorder');
    Route::post('/visited','AdminController@visited');
    Route::post('/okorder','AdminController@okorder');
    Route::post('/complet_order','AdminController@complet_order');
    Route::get('/users','AdminController@users');
    Route::get('/user/{id}','AdminController@get_user');
    Route::get('/files','AdminController@files');
    Route::get('/get_files/{order_id?}','AdminController@get_files');
    Route::get('/delete_file_admin/{id}','AdminController@delete_file_admin');
    Route::post('/delete_admin_files','AdminController@delete_admin_files');
    Route::post('/Delivery','AdminController@Delivery');
    Route::get('/news','AdminController@news');
    Route::post('/add_news','AdminController@add_news');
    Route::get('/get_news','AdminController@get_news');
    Route::post('/delete_new','AdminController@delete_new');
    Route::post('/new_edit','AdminController@new_edit');

});
// ---------  images
Route::post('/delete_img','UserController@delete_img');
Route::post('/upload_img_user','UserController@upload_img_user');
// global
Route::get('/contact','HomeController@contact');
Route::get('/about','HomeController@about');
Route::get('/news','HomeController@news');
Route::get('/news/{id}','HomeController@singlenews');
