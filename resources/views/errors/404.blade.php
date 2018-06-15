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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
        <div class="container">

          <div class="error">
            <div class="error-block">
              <img class="main-img" src="/images/404.png" alt="Img 404">
              <h3>您要找的页面不存在</h3>
              <div class="sub-title">可能是因为您的链接地址有误、该文章已经被作者删除或转为私密状态。</div>
              <a class="follow" href="{{ url('/') }}">返回「View」首页</a>
            </div>
          </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
