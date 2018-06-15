@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row collection">
    <!--  -->
    <div class="col-xs-8 main">
      <!--  -->
      <div class="main-top">
        <a class="avatar-collection" href="/c/fcd7a62be697">
          <img src="{{ $category ->cover }}" alt="240">
        </a>

        @if(!$category -> categoryKeep(Auth::id()) -> exists())
        <a class="btn btn-success follow" href="{{ route('categories.categoryKeep', $category) }}">
          <i class="iconfont ic-follow"></i> <span>关注</span>
        </a>
        @else
        <a class="btn btn-success follow" href="{{ route('categories.unCategoryKeep', $category) }}">
          <i class="iconfont ic-follow"></i> <span>取消关注</span>
        </a>
        @endif

        <div class="title">
          <a class="name" href="#">{{ $category ->name }}</a>
        </div>
        <div class="info">
          收录了{{ $category ->article_count }}篇文章 · {{ $category ->categoryKeeps ->count() }}人关注
        </div>
      </div>
      <!--  -->
      <ul class="trigger-menu">
        <li class="active">
          <a href="#">
            <i class="iconfont ic-latestcomments"></i> 最新文章
          </a>
        </li>
      </ul>
      <!--  -->
      <div class="list-container">
        <ul class="note-list">
          <!--  -->
          @if(count($category ->article) > 0)
          @foreach($category ->article as $article)
          <li class="have-img">
            <a class="wrap-img" href="{{ route('articles.show', $article) }}" target="_blank">
              <img class="img-blur-done" src="{{ $article ->cover }}" alt="120">
            </a>
            <div class="content">
              <a class="title" target="_blank" href="{{ route('articles.show', $article) }}">{{ $article ->title }}</a>
              <p class="abstract">
                {{ $article ->abstract }}
              </p>
              <div class="meta">
                <a class="nickname" target="_blank" href="{{ route('users.show', $article ->user) }}">{{ $article ->user ->name }}</a>
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
          @else
          <li>
            @include('commons._empty')
          </li>
          @endif
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
