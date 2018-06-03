@extends('layouts.app')

@section('content')
<div class="container person">
  <div class="row">
    <!-- Left -->
    <div class="col-xs-8 main" style="background-color: #FFF; padding-top: 20px;">
      <div class="main-top clearfix">
        <a class="avatar" href="/u/606f73047662">
          <img src="//upload.jianshu.io/users/upload_avatars/4743930/0579ea6b-8c13-4178-b122-314178aad51d?imageMogr2/auto-orient/strip|imageView2/1/w/240/h/240" alt="240">
        </a>
        <div class="title">
          <a class="name" href="/u/606f73047662">驹强贯世文武英杰</a>
        </div>
        <div class="info">
          <ul>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="/u/606f73047662">
                  <p>1</p>
                  关注 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="/u/606f73047662">
                  <p>1</p>
                  粉丝 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="/u/606f73047662">
                  <p>1</p>
                  文章 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="/u/606f73047662">
                  <p>1</p>
                  收获喜欢 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
          </ul>
        </div>

        <button class="setting-btn">编辑个人资料</button>
      </div>

      <!--  -->
      <ul class="trigger-menu">
        <li class="active">
          <a href="/u/606f73047662?order_by=shared_at">
            <i class="iconfont ic-articles"></i> 文章
          </a>
        </li>
        <li class="">
          <a href="/users/606f73047662/timeline">
            <i class="iconfont ic-feed"></i> 吐槽
          </a>
        </li>
        <li class="">
          <a href="/u/606f73047662?order_by=commented_at">
            <i class="iconfont ic-latestcomments"></i> 评论
          </a>
        </li>
      </ul>

      <!--  -->
      <div class="list-container">
        <ul class="note-list">
          <li>
            <div class="content">
              <a class="title" target="_blank" href="/p/63015f619cf2">测试一下</a>
              <p class="abstract">
                测试一下
              </p>
              <div class="meta">
                <a target="_blank" href="/p/63015f619cf2">
                  <i class="iconfont ic-list-read"></i> 2
                </a>
                <a target="_blank" href="/p/63015f619cf2#comments">
                  <i class="iconfont ic-list-comments"></i> 0
                </a>
                <span><i class="iconfont ic-list-like"></i> 0</span>
                <span class="time">前天 08:46</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Right -->
    <div class="col-xs-4">

    </div>
  </div>
</div>
@endsection
