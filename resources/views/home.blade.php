@extends('layouts.app')

@section('content')
<div class="container index">

  @if(!Auth::check())
  <!-- 未登陆警告 -->
  <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>提示!</strong> 登陆后才能体验更多功能偶~~
  </div>
  @endif

  <div class="row">
    <!-- Left -->
    <div class="col-xs-8 main">
      <!-- 文章分类 -->
      <div class="recommend-collection">
        @foreach($categories as $category)
        <a class="collection" target="_blank" href="{{ route('categories.show', $category) }}" alt="{{ $category ->description }}">
          <img src="//upload.jianshu.io/collections/images/494271/51164a1egd7b1a4a7c491_690.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/64/h/64" alt="64">
          <div class="name">{{ $category ->name }}</div>
        </a>
        @endforeach
        <a class="more-hot-collection" target="_blank" href="{{ route('categories.index') }}">点击查看更多热门专题 >></a>
      </div>
      <!-- 线 -->
      <div class="split-line"></div>
      <!-- 文章列表模块 -->
      <div id="list-container">
        <ul class="note-list">
          <!--  -->
          @foreach($articles as $article)
          <li id="article_{{ $article ->id }}" @if($article ->cover) class="have-img" @endif>
            <a class="wrap-img" href="{{ route('articles.show', $article) }}" target="_blank">
              <img class="img-blur-done" src="{{ $article ->cover }}" alt="120">
            </a>
            <div class="content">
              <a class="title" target="_blank" href="{{ route('articles.show', $article) }}">{{ $article ->title }}</a>
              <p class="abstract">
                {{ $article ->abstract }}
              </p>
              <div class="meta">
                <!-- 作者 -->
                <a class="nickname" target="_blank" href="{{ route('users.show', $article ->user ->id ) }}" data-id="{{ $article ->user ->id }}">
                  <i class="glyphicon glyphicon-user"></i> {{ $article ->user ->name }}
                </a>
                <!-- 评论 -->
                <a target="_blank" href="/p/fb27470dc426#comments">
                  <i class="glyphicon glyphicon-comment"></i> {{ $article ->comment_count }}
                </a>
                <!-- 喜欢 -->
                <span><i class="glyphicon glyphicon-heart"></i> {{ $article ->articleZans($article ->user ->id) ->count() }}</span>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <!-- Right -->
    <div class="col-xs-4 aside">
      <div class="board">
        <!-- 注册 -->

        <!-- 招商合作 -->
        @include('commons._advertising')

        <!-- 推荐作者 -->
        @include('commons._recommend_the_authors')

        <!-- 作者排行 -->
        @include('commons._seniority_author')

        <!-- 吐槽 -->

        <!-- 友情链接 -->
        @include('commons._links')

      </div>
    </div>
  </div>
</div>
@endsection
