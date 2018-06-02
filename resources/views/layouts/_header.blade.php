<nav class="navbar navbar-default" role="navigation">
  <div class="width-limit">
    <!-- logo -->
    <a class="logo" href="{{ url('/') }}">
      <i></i>
      <span class="logo-text">View</span> <small>带你发现不一样的世界</small>
    </a>

    @guest
    <a class="sign-up" href="{{ route('register') }}">注册</a>
    <a class="log-in" href="{{ route('login') }}">登录</a>
    @else
    <!--  -->
    <a class="btn write-btn" target="_blank" href="">
      <i class="glyphicon glyphicon-pencil"></i> 写文章
    </a>
    <!--  -->
    <div class="user">
      <div data-hover="dropdown" class="">
        <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <img class="img-thumbnail" src="//upload.jianshu.io/users/upload_avatars/4743930/0579ea6b-8c13-4178-b122-314178aad51d?imageMogr2/auto-orient/strip|imageView2/1/w/120/h/120" alt="120">
          <span>{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                退出登录
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </div>
    </div>
    @endguest


    <!--  -->
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="nav navbar-nav">
          <!--  -->
          <li class="search">
            <form target="_blank" action="/search" accept-charset="UTF-8" method="get">
              <input name="utf8" type="hidden" value="✓">
              <input type="text" name="q" id="q" value="" autocomplete="off" placeholder="按下回车搜索" class="search-input">
              <a class="search-btn" href="javascript:void(null)"><i class="glyphicon glyphicon-search"></i></a>
            </form>
          </li>

          <li class="tab active">
            <a href="{{ url('/') }}">
              <i class="glyphicon glyphicon-eye-open menu-icon"></i> <span class="menu-text">发现</span>
            </a>
          </li>
          <li class="tab">
            <a href="/subscriptions">
              <i class="glyphicon glyphicon-star menu-icon"></i> <span class="menu-text">关注</span>
            </a>
          </li>
          <li class="tab notification">
            <a href="/subscriptions" class="notification-btn">
              <i class="glyphicon glyphicon-envelope menu-icon"></i> <span class="menu-text">消息</span>
              <span class="badge">2</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>