@extends('layouts.app')

@section('content')
<div class="container index">
  <div class="row">
    <!-- Left -->
    <div class="col-xs-8 main">
      <!-- 文章分类 -->
      <div class="recommend-collection">
        @foreach($categories as $category)
        <a class="collection" target="_blank" href="/c/b676c24f7d60?utm_medium=index-collections&amp;utm_source=desktop" alt="{{ $category ->description }}">
          <img src="//upload.jianshu.io/collections/images/494271/51164a1egd7b1a4a7c491_690.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/64/h/64" alt="64">
          <div class="name">{{ $category ->name }}</div>
        </a>
        @endforeach
        <a class="more-hot-collection" target="_blank" href="/recommendations/collections?utm_medium=index-collections&amp;utm_source=desktop">
              点击查看更多热门专题 >>
        </a>
      </div>
      <!-- 线 -->
      <div class="split-line"></div>
      <!-- 文章列表模块 -->
      <div id="list-container">
        <ul class="note-list">
          <!--  -->
          <li id="note-28386796" data-note-id="28386796" class="have-img">
            <a class="wrap-img" href="/p/fb27470dc426" target="_blank">
              <img class="  img-blur-done" src="//upload-images.jianshu.io/upload_images/2041831-0e4aab17ceb60dbf.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" alt="120">
            </a>
            <div class="content">
              <a class="title" target="_blank" href="/p/fb27470dc426">全职与兼职写作该如何选择</a>
              <p class="abstract">
                每个人都有梦想中的生活，很多年前，我一直想，若是那天，我可以一杯茶，一本书，然后躺在阳台上的躺椅里就可以消耗完一天的时光那多好。那时候这样的生活...
              </p>
              <div class="meta">
                <!-- 作者 -->
                <a class="nickname" target="_blank" href="/u/46abcf684093">
                  <i class="glyphicon glyphicon-user"></i> 无戒
                </a>
                <!-- 评论 -->
                <a target="_blank" href="/p/fb27470dc426#comments">
                  <i class="glyphicon glyphicon-comment"></i> 69
                </a>
                <!-- 喜欢 -->
                <span><i class="glyphicon glyphicon-heart"></i> 94</span>
              </div>
            </div>
          </li>
          <!--  -->
          <!--  -->

          <!--  -->
        </ul>
      </div>
    </div>
    <!-- Right -->
    <div class="col-xs-4 aside">
      <div class="board">
        <!--  -->
        <div class="welcome_side welcome_side">
          <div class="section shadow auth-section">
            <div class="title">
              <span>View - 注册</span>
            </div>
            <small class="ticket">带你发现不一样的世界</small>
            <!--  -->
            <form class="" action="{{ route('register') }}" method="post">
              {{ csrf_field() }}
              <div class="input-group">
                <div class="input-box">
                  <input name="name" maxlength="20" placeholder="用户名" class="input">
                </div>
                <div class="input-box">
                  <input name="email" placeholder="email" class="input">
                </div>
                <div class="input-box">
                  <input name="password" type="password" placeholder="密码（不少于 6 位）" class="input">
                </div>
                <div class="input-box">
                  <input name="password" type="password" placeholder="重复密码" class="input">
                </div>
              </div>
              <button class="btn btn-info">立即注册</button>
            </form>
          </div>
        </div>

        <!--  -->
        <div class="welcome_side welcome_side recommended-authors">
          <div class="section shadow auth-section">
            <div class="title">
              <span>推荐作者</span>
              <a class="page-change" href="/">
                <i class="glyphicon glyphicon-repeat"></i> 换一批
              </a>
            </div>
            <ul class="list">
              <!--  -->
              <li>
                <a href="" target="_blank" class="avatar">
                  <img src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96"></a> <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注
                </a>
                <a href="/u/13cba2dc6b23?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">
                  汪波_偶遇科学
                </a>
                <p> 1k喜欢</p>
              </li>
              <!--  -->
            </ul>
          </div>
        </div>

        <!--  -->
        <div class="welcome_side welcome_side recommended-authors">
          <div class="section shadow auth-section">
            <div class="title">
              <span>作者排行</span>
            </div>
            <ul class="list">
              <!--  -->
              <li class="clearfix">
                <span class="author-num pull-left">
                  <strong class="badge">1</strong>
                </span>
                <a href="" target="_blank" class="avatar">
                  <img src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96"></a> <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注
                </a>
                <a href="/u/13cba2dc6b23?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">
                  汪波_偶遇科学
                </a>
                <p> 1k喜欢</p>
              </li>
              <!--  -->
              <!--  -->
              <li class="clearfix">
                <span class="author-num pull-left">
                  <strong class="badge">2</strong>
                </span>
                <a href="" target="_blank" class="avatar">
                  <img src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96"></a> <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注
                </a>
                <a href="/u/13cba2dc6b23?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">
                  汪波_偶遇科学
                </a>
                <p> 1k喜欢</p>
              </li>
              <!--  -->
              <!--  -->
              <li class="clearfix">
                <span class="author-num pull-left">
                  <strong class="badge">3</strong>
                </span>
                <a href="" target="_blank" class="avatar">
                  <img src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96"></a> <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注
                </a>
                <a href="/u/13cba2dc6b23?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">
                  汪波_偶遇科学
                </a>
                <p> 1k喜欢</p>
              </li>
              <!--  -->
            </ul>
          </div>
        </div>

        <!--  -->
        <div class="welcome_side welcome_side dynamic">
          <div class="section shadow auth-section">
            <div class="title">
              <span>随便吐槽点什么吧</span>
            </div>

            <form class="" action="index.html" method="post">
              {{ csrf_field() }}
              <input type="text" name="dynamic" placeholder="全世界都能看到你说的,请谨慎发言" required="required">
              <button type="submit" class="btn btn-info">点击发表动弹</button>
            </form>

            <ul class="dynamic-list">
              <!--  -->
              <li class="dynamic-item">
                <a class="dynamic-img">
                  <img class="img-circle img-thumbnail" src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96" alt="咋了猪咋了"/>
                </a>
                <div class="dynamic-meta">
                  <a class="UserLink-link" target="_blank" href="">咋了猪咋了：</a>
                </div>
                <div class="dynamic-content">
                  <p>问这种问题的一般是人都认不全的人。</p>
                </div>
                <div class="dynamic-option">
                  <span><i class="glyphicon glyphicon-time"></i> 2018-3-21</span>
                </div>
              </li>
              <!--  -->
              <li class="dynamic-item">
                <a class="dynamic-img">
                  <img class="img-circle img-thumbnail" src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96" alt="咋了猪咋了"/>
                </a>
                <div class="dynamic-meta">
                  <a class="UserLink-link" target="_blank" href="">咋了猪咋了：</a>
                </div>
                <div class="dynamic-content">
                  <p>问这种问题的一般是人都认不全的人。</p>
                </div>
                <div class="dynamic-option">
                  <span><i class="glyphicon glyphicon-time"></i> 2018-3-21</span>
                </div>
              </li>
              <!--  -->
            </ul>
          </div>
        </div>

        <!--  -->
        <div class="welcome_side welcome_side links">
          <div class="section shadow auth-section">
            <div class="title">
              <span>友情链接</span>
            </div>

            <ul class="links-list">
              <li>
                <a href="https://ruby-china.org" target="_blank" rel="nofollow" title="Ruby China" style="padding: 3px;line-height: 40px;">
                    <img src="https://lccdn.phphub.org/assets/images/friends/ruby-china.png" style="width:150px; margin: 3px 0;">
                </a>
              </li>
              <li>
                <a href="https://pythoncaff.com" target="_blank" rel="nofollow" title="PythonCaff 社区" style="padding: 3px;line-height: 40px;">
                    <img src="https://lccdn.phphub.org/uploads/banners/t8haiJA74SLAJj1aL1xv.png" style="width:150px; margin: 3px 0;">
                </a>
              </li>
              <li>
                <a href="http://cnodejs.org/" target="_blank" rel="nofollow" title="CNode：Node.js 中文社区" style="padding: 3px;line-height: 40px;">
                    <img src="https://lccdn.phphub.org/assets/images/friends/cnodejs.png" style="width:150px; margin: 3px 0;">
                </a>
              </li>
              <li>
                <a href="https://testerhome.com" target="_blank" rel="nofollow" title="Tester Home" style="padding: 3px;line-height: 40px;">
                    <img src="https://lccdn.phphub.org/testerhome-logo.png" style="width:150px; margin: 3px 0;">
                </a>
              </li>
              <li>
                <a href="https://www.easywechat.com/" target="_blank" rel="nofollow" title="EasyWeChat 微信开发，从未如此简单" style="padding: 3px;line-height: 40px;">
                    <img src="https://lccdn.phphub.org/uploads/banners/yN7mJNvKsNvfwYSZw2Yp.png" style="width:150px; margin: 3px 0;">
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!--  -->
        <div class="banner section shadow welcome_side">
          <div class="section shadow auth-section">
            <div class="title">
              <span>招商合作</span>
            </div>

            <a href="#">
              <div class="banner-image" style="background-image: url('https://user-gold-cdn.xitu.io/15276471188444d71ed4f8d8a92b5f5d5e487f09e205e.jpg?imageView2/1/q/85/format/webp/interlace/1'); background-size: cover;"></div>
            </a>

            <a href="#">
              <div class="banner-image" style="background-image: url('https://user-gold-cdn.xitu.io/15270660342935e649d1de39dde6197109a92635f8cea.jpg?imageView2/1/q/85/format/webp/interlace/1'); background-size: cover;"></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
