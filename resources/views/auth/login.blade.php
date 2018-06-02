<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>登录</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="EntrySign-body">
    <div id="app" class="{{ route_class() }}-page">
      <main class="SignFlowHomepage">
        <div class="SignFlowHomepage-content">
          <div class="Card SignContainer-content">
            <!--  -->
            <div class="SignFlowHeader" style="padding-bottom:5px">
              <h1 class="SignFlowHeader-title">View</h1>
              <div class="SignFlowHeader-slogen">登录我们，发现更大的世界</div>
            </div>
            <!--  -->
            <div class="SignContainer-inner">
              <div class="Register">
                <div>
                  <div class="Register-content">
                    <form class="" action="{{ route('login') }}" method="post">
                      {{ csrf_field() }}

                      <!-- 邮箱 -->
                      <div class="SignFlow-account">
                          <div class="SignFlow-supportedCountriesSelectContainer">
                              <div class="Popover SignFlow-supportedCountriesSelect">
                                  <span class="Popover_text">邮箱</span>
                              </div>
                          </div>
                          <div class="SignFlowInput SignFlow-accountInputContainer">
                              <div class="Input-wrapper">
                                  <input id="email" type="email" class="Input" name="email" value="{{ old('email') }}" placeholder="请输入邮箱地址" required autofocus>
                              </div>
                          </div>
                      </div>
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif

                      <!-- 密码 -->
                      <div class="SignFlow-account">
                          <div class="SignFlow-supportedCountriesSelectContainer">
                              <div class="Popover SignFlow-supportedCountriesSelect">
                                  <span class="Popover_text">密码</span>
                              </div>
                          </div>
                          <div class="SignFlowInput SignFlow-accountInputContainer">
                              <div class="Input-wrapper">
                                <input id="password" type="password" class="Input" name="password" placeholder="请输入密码" required>
                              </div>
                          </div>
                      </div>
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif

                      <!-- 记住我 -->
                      <div class="SignFlow-account" style="border-bottom: 0 none;">
                            <div class="checkbox clearfix">
                                <label class="pull-left">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                </label>

                                <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                                    忘记密码?
                                </a>
                            </div>
                      </div>

                      <button type="submit" class="Button Register-submitButton Button--primary Button--blue">注册</button>
                    </form>
                  </div>
                </div>
              </div>

              <div class="SignContainer-switch">
                还没有有账号?
                <a href="{{ route('register') }}">
                  <span>点击注册</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
