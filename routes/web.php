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
Route::get('/', 'HomeController@index') ->name('/');
Route::get('/search', 'HomeController@search') ->name('search');

// 前台注册登录路由
Auth::routes();

// 前台文章路由
Route::get('articles/home', 'ArticlesController@home') ->name('articles.home');
Route::post('upload_image', 'ArticlesController@uploadImage')->name('articles.upload_image');
// 赞
Route::get('articles/{id}/zan', 'ArticlesController@articleZan') ->name('articles.zan');
Route::get('articles/{id}/unzan', 'ArticlesController@unArticleZan') ->name('articles.unzan');
// 赞
Route::get('articles/{id}/collect', 'ArticlesController@articleCollect') ->name('articles.collect');
Route::get('articles/{id}/uncollect', 'ArticlesController@unArticleCollect') ->name('articles.uncollect');
Route::resource('articles', 'ArticlesController');

// 关注与取消关注
Route::get('categories/{id}/categoryKeep', 'CategoriesController@categoryKeep') ->name('categories.categoryKeep');
Route::get('categories/{id}/unCategoryKeep', 'CategoriesController@unCategoryKeep') ->name('categories.unCategoryKeep');
// 展示所有关注用户
Route::get('categories/allkeep/{id?}', 'CategoriesController@allKeep') ->name('categories.allKeep');
// 前台文章分类路由
Route::resource('categories', 'CategoriesController');

// 前台用户路由
Route::resource('users', 'UsersController');

// 前台文章回复路由
Route::get('comments/{id}/report', 'CommentsController@commentReport') ->name('comments.report');
Route::get('comments/{id}/zan', 'CommentsController@commentZan') ->name('comments.zan');
Route::get('comments/{id}/unzan', 'CommentsController@unCommentZan') ->name('comments.unzan');
Route::resource('comments', 'CommentsController');

// 前台文章回复通知路由
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

//关注用户操作
Route::get('followers', 'FollowersController@index')->name('followers');
Route::post('followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('followers/{user}', 'FollowersController@destroy')->name('followers.destroy');

// 帮助中心 - 意见反馈
Route::resource('helps', 'HelpsController');

// 文集
Route::resource('works', 'WorksController');

// 文集内部文章
Route::get('topics/write/{id}', 'WorkTopicsController@write') ->name('topics.write');
Route::resource('topics', 'WorkTopicsController');

// 标签云
Route::resource('tags', 'TagsController');

// 后台路由搭建
include_once('admin.php');
