<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin_login.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
  <div class="sign">

    <!--  -->
    <div class="main">
      <h4 class="title">
        <div class="normal-title">
          <a class="active" href="/sign_in">后台登录</a>
        </div>
      </h4>

      <!--  -->
      <div class="js-sign-in-container clearfix">
        @include('commons._message')
        @include('commons._error')

        <form class="" action="{{ route('admin.login') }}" method="post">
          {{ csrf_field() }}

          <!-- 用户名 -->
          <div class="input-prepend restyle js-normal">
            <input placeholder="用户名" type="text" name="name" id="name">
            <i class="glyphicon glyphicon-user"></i>
          </div>

          <!-- 密码 -->
          <div class="input-prepend restyle js-normal">
            <input placeholder="密码" type="password" name="password" id="password">
            <i class="glyphicon glyphicon-lock"></i>
          </div>

          <!-- 登录 -->
          <button class="sign-in-button" id="sign-in-form-submit-btn" type="submit">
            <span id="sign-in-loading"></span>
            登录
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
