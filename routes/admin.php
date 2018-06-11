<?php
Route::group(['prefix' => '/admin'], function () {
  // 登陆页面
  Route::get('/login', '\App\Admin\Controllers\LoginController@index') ->name('admin.loginIndex');
  Route::post('/login', '\App\Admin\Controllers\LoginController@login') ->name('admin.login');
  Route::get('/logout', '\App\Admin\Controllers\LoginController@logout') ->name('admin.logout');

  Route::group(['middleware' => 'auth:admin'], function () {
        // 首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index') ->name('admin.home');

      Route::group(['middleware' => 'can:System'], function(){
        // 用户
        Route::get('/users', '\App\Admin\Controllers\UsersController@index') ->name('admin.users');
        Route::get('/users/create', '\App\Admin\Controllers\UsersController@create') ->name('admin.users.create');
        Route::post('/users/store', '\App\Admin\Controllers\UsersController@store') ->name('admin.users.store');
        Route::get('/users/{user}/role', '\App\Admin\Controllers\UsersController@role') ->name('admin.users.role');
        Route::post('/users/{user}/role', '\App\Admin\Controllers\UsersController@storeRole') ->name('admin.users.storeRole');

        // 角色
        Route::get('/roles', '\App\Admin\Controllers\RolesController@index') ->name('admin.roles');
        Route::get('/roles/create', '\App\Admin\Controllers\RolesController@create') ->name('admin.roles.create');
        Route::post('/roles/store', '\App\Admin\Controllers\RolesController@store') ->name('admin.roles.store');
        Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RolesController@permission') ->name('admin.roles.permission');
        Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RolesController@storePermission') ->name('admin.roles.storePermission');

        // 权限
        Route::get('/permissions', '\App\Admin\Controllers\PermissionsController@index') ->name('admin.permissions');
        Route::get('/permissions/create', '\App\Admin\Controllers\PermissionsController@create') ->name('admin.permissions.create');
        Route::post('/permissions/store', '\App\Admin\Controllers\PermissionsController@store') ->name('admin.permissions.store');
    });

    Route::group(['middleware' => 'can:Article'], function(){
      // 文章审核
      Route::get('/articles', '\App\Admin\Controllers\ArticlesController@index') ->name('admin.articles');
      Route::get('/articles/{id}/status/{status}', '\App\Admin\Controllers\ArticlesController@status') ->name('admin.articles.status');
    });

  });
});
