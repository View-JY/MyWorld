<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>创建文章</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
      <div class="article-wrapper">
        <!--  -->
        <header class="article-header clearfix">
          <div class="article-logo">
            <a href="{{ url('/') }}">View</a>
          </div>
        </header>
        <!--  -->
        <div class="container">

          <!--  -->
          <div class="HomeTop">
            <h3>随心写作，自由表达</h3>
            <a target="_blank" href="{{ route('articles.create') }}" type="button" class="Button HomeTop-btn">开始写文章</a>
          </div>

          <!--  -->
          <section>
            <!--  -->
            <div class="blockTitle">
              <p class="blockTitle-title">专题 · 发现</p>
              <span class="blockTitle-line"></span>
            </div>
            <!--  -->
            <ul class="homeColumn-list">
              <!--  -->
              <li class="homeColumn-item col-xs-3">
                <p class="HomeColumn-avatar">
                  <a target="_blank" href="/dejavu">
                    <img class="Avatar-hemingway" alt="专栏头像" src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                  </a>
                </p>
                <p class="HomeColumn-title">
                  <a target="_blank" href="/dejavu">déjà vu</a>
                </p>
                <p class="HomeColumn-description">
                  <a target="_blank" href="/dejavu">文献、理论、案例、学术笔记、咨询手记。关...</a>
                </p>
                <p class="HomeColumn-meta">
                  2,353人关注<span> | </span>
                  0篇文章
                </p>
                <a target="_blank" href="/dejavu" type="button" class="Button HomeColumn-btn Button--green">
                  进入专栏
                </a>
              </li>
              <!--  -->
              <li class="homeColumn-item col-xs-3">
                <p class="HomeColumn-avatar">
                  <a target="_blank" href="/dejavu">
                    <img class="Avatar-hemingway" alt="专栏头像" src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                  </a>
                </p>
                <p class="HomeColumn-title">
                  <a target="_blank" href="/dejavu">déjà vu</a>
                </p>
                <p class="HomeColumn-description">
                  <a target="_blank" href="/dejavu">文献、理论、案例、学术笔记、咨询手记。关...</a>
                </p>
                <p class="HomeColumn-meta">
                  2,353人关注<span> | </span>
                  0篇文章
                </p>
                <a target="_blank" href="/dejavu" type="button" class="Button HomeColumn-btn Button--green">
                  进入专栏
                </a>
              </li>
              <!--  -->
              <li class="homeColumn-item col-xs-3">
                <p class="HomeColumn-avatar">
                  <a target="_blank" href="/dejavu">
                    <img class="Avatar-hemingway" alt="专栏头像" src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                  </a>
                </p>
                <p class="HomeColumn-title">
                  <a target="_blank" href="/dejavu">déjà vu</a>
                </p>
                <p class="HomeColumn-description">
                  <a target="_blank" href="/dejavu">文献、理论、案例、学术笔记、咨询手记。关...</a>
                </p>
                <p class="HomeColumn-meta">
                  2,353人关注<span> | </span>
                  0篇文章
                </p>
                <a target="_blank" href="/dejavu" type="button" class="Button HomeColumn-btn Button--green">
                  进入专栏
                </a>
              </li>
              <!--  -->
              <li class="homeColumn-item col-xs-3">
                <p class="HomeColumn-avatar">
                  <a target="_blank" href="/dejavu">
                    <img class="Avatar-hemingway" alt="专栏头像" src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                  </a>
                </p>
                <p class="HomeColumn-title">
                  <a target="_blank" href="/dejavu">déjà vu</a>
                </p>
                <p class="HomeColumn-description">
                  <a target="_blank" href="/dejavu">文献、理论、案例、学术笔记、咨询手记。关...</a>
                </p>
                <p class="HomeColumn-meta">
                  2,353人关注<span> | </span>
                  0篇文章
                </p>
                <a target="_blank" href="/dejavu" type="button" class="Button HomeColumn-btn Button--green">
                  进入专栏
                </a>
              </li>
            </ul>
          </section>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
