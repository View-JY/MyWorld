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

// 前台首页路由
Route::resource('/', 'HomeController');

// 前台注册登录路由
Auth::routes();

// 前台文章路由
Route::get('articles/home', 'ArticlesController@home') ->name('articles.home');
Route::post('upload_image', 'ArticlesController@uploadImage')->name('articles.upload_image');
Route::resource('articles', 'ArticlesController');

// 前台文章分类路由
Route::resource('categories', 'CategoriesController');

// 前台用户路由
Route::resource('users', 'UsersController');
