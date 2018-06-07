@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row collection">
    <!--  -->
    <div class="col-xs-8 main">
      <!--  -->
      <div class="main-top">
        <a class="avatar-collection" href="/c/fcd7a62be697">
          <img src="//upload.jianshu.io/collections/images/95/1.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/240/h/240" alt="240">
        </a>
        <a class="btn btn-success follow">
          <i class="iconfont ic-follow"></i> <span>关注</span>
        </a>
        <div class="btn btn-hollow js-contribute-button">
          投稿
        </div>
        <div class="title">
          <a class="name" href="/c/fcd7a62be697">{{ $category ->name }}</a>
        </div>
        <div class="info">
          收录了{{ $category ->article_count }}篇文章 · 977271人关注
        </div>
      </div>
      <!--  -->
      <ul class="trigger-menu">
        <li class="active">
          <a href="/c/fcd7a62be697?order_by=commented_at">
            <i class="iconfont ic-latestcomments"></i> 最新评论
          </a>
        </li>
      </ul>
      <!--  -->
      <div class="list-container">
        <ul class="note-list">
          <!--  -->
          @foreach($category ->article as $article)
          <li id="note-29069112" data-note-id="29069112" class="have-img">
            <a class="wrap-img" href="/p/2aa0525ce316" target="_blank">
              <img class="img-blur-done" src="{{ $article ->cover }}" alt="120">
            </a>
            <div class="content">
              <a class="title" target="_blank" href="/p/2aa0525ce316">{{ $article ->title }}</a>
              <p class="abstract">
                {{ $article ->abstract }}
              </p>
              <div class="meta">
                <a class="nickname" target="_blank" href="/u/9008d8458f8f">{{ $article ->user ->name }}</a>
                  <a target="_blank" href="/p/2aa0525ce316#comments">
                    <i class="glyphicon glyphicon-comment"></i> {{ $article ->comment_count }}
                  </a>
                  <span>
                    <i class="glyphicon glyphicon-heart"></i> 0
                  </span>
              </div>
            </div>
          </li>
          @endforeach
          <!--  -->
        </ul>
      </div>
    </div>

    <!--  -->
    <div class="col-xs-4">
      <div class="aside">
        <p class="title">专题公告</p>
        <div class="description js-description">
          <p>{{ $category ->description }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
