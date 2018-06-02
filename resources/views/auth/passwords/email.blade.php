<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>重置密码</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="EntrySign-body">
    <div id="app" class="{{ route_class() }}-page">
      <main class="SignFlowHomepage">
        @if (session('status'))
          <div class="alert alert-info resetEmail-success">
              {{ session('status') }}
          </div>
        @endif
        <div class="SignFlowHomepage-content">
          <div class="Card SignContainer-content">
            <!--  -->
            <div class="SignFlowHeader" style="padding-bottom:5px">
              <h1 class="SignFlowHeader-title">View</h1>
              <div class="SignFlowHeader-slogen">找回密码</div>
            </div>
            <!--  -->
            <div class="SignContainer-inner">
              <div class="Register">
                <div>
                  <div class="Register-content">
                    <form class="" action="{{ route('password.email') }}" method="post">
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
                                  <input id="email" type="email" class="Input" placeholder="请输入邮箱地址" name="email" value="{{ old('email') }}" required autofocus>
                              </div>
                          </div>
                      </div>
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif

                      <button type="submit" class="Button Register-submitButton Button--primary Button--blue">点击获取重置密码链接</button>
                    </form>
                  </div>
                </div>
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
