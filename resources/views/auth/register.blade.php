<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>注册</title>

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
              <div class="SignFlowHeader-slogen">注册我们，发现更大的世界</div>
            </div>
            <!--  -->
            <div class="SignContainer-inner">
              <div class="Register">
                <div>
                  <div class="Register-content">
                    <form class="" action="{{ route('register') }}" method="post">
                      {{ csrf_field() }}
                      <!-- 姓名 -->
                      <div class="SignFlow-account">
                          <div class="SignFlow-supportedCountriesSelectContainer">
                              <div class="Popover SignFlow-supportedCountriesSelect">
                                  <span class="Popover_text">用户名</span>
                              </div>
                          </div>
                          <div class="SignFlowInput SignFlow-accountInputContainer">
                              <div class="Input-wrapper">
                                  <input id="name" type="text" class="Input" name="name" value="{{ old('name') }}" placeholder="请输入用户名" required autofocus>
                              </div>
                          </div>
                      </div>
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif

                      <!-- 邮箱 -->
                      <div class="SignFlow-account">
                          <div class="SignFlow-supportedCountriesSelectContainer">
                              <div class="Popover SignFlow-supportedCountriesSelect">
                                  <span class="Popover_text">邮箱</span>
                              </div>
                          </div>
                          <div class="SignFlowInput SignFlow-accountInputContainer">
                              <div class="Input-wrapper">
                                  <input id="email" type="email" class="Input" name="email" value="{{ old('email') }}" placeholder="请输入邮箱" required>
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
                          <span class="help-block" >
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif

                      <!-- 确认密码 -->
                      <div class="SignFlow-account">
                          <div class="SignFlow-supportedCountriesSelectContainer">
                              <div class="Popover SignFlow-supportedCountriesSelect">
                                  <span class="Popover_text">确认密码</span>
                              </div>
                          </div>
                          <div class="SignFlowInput SignFlow-accountInputContainer">
                              <div class="Input-wrapper">
                                  <input id="password-confirm" type="password" class="Input" name="password_confirmation" placeholder="请再次输入密码" required>
                              </div>
                          </div>
                      </div>
                      @if ($errors->has('password_confirmation'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif

                      <!-- 验证码 -->
                      <div class="SignFlow-account" style="position: relative;">
                          <div class="SignFlow-supportedCountriesSelectContainer">
                              <div class="Popover SignFlow-supportedCountriesSelect">
                                  <span class="Popover_text">验证码</span>
                              </div>
                          </div>
                          <div class="SignFlowInput SignFlow-accountInputContainer">
                              <div class="Input-wrapper">
                                  <input type="text" id="captcha" name="captcha" value="" class="Input" placeholder="请输入验证码" required="">
                              </div>
                          </div>
                          <!-- 验证码 -->
                          <img class="thumbnail captcha" style="position: absolute; top: -9.5px; right:0; cursor: pointer;" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                      </div>
                      @if ($errors->has('captcha'))
                          <span class="help-block">
                              <strong>{{ $errors->first('captcha') }}</strong>
                          </span>
                      @endif

                      <button type="submit" class="Button Register-submitButton Button--primary Button--blue" style="margin-top: 30px;">注册</button>
                    </form>
                  </div>
                </div>
              </div>

              <div class="SignContainer-switch">
                已有账号?
                <a href="{{ route('login') }}">
                  <span>点击登录</span>
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
