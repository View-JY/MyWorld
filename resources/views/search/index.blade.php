@extends('layouts.app')

@section('content')
<div class="container search">
  <div class="row clearfix" style="background:#FFF; min-height: 250px;">
    <!--  -->
    <div class="aside">
      <div>
        <ul class="menu">
          <li class="active">
            <a>
              <div class="setting-icon"><i class="glyphicon glyphicon-file"></i></div>
              <span>文章</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="search-trending" style="display: none;">
        <div class="search-trending-header clearfix">
          <span>热门搜索</span>
        </div>
        <ul class="search-trending-tag-wrap">
          <li>
            <a href="" target="_blank">区块链</a>
          </li>
        </ul>
      </div>

      <div class="search-recent" style="display: none;">
        <div class="search-recent-header clearfix">
          <span>最近搜索</span>
          <a class="pull-right" href="#">清空</a>
        </div>
        <ul class="search-recent-item-wrap">
          <li>
            <a href="" target="_blank">
              <i class="glyphicon glyphicon-time" style="top:3px;"></i>
              <span>1111</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!--  -->
    <div class="col-xs-16 col-xs-offset-8 main">
      @if(count($users) > 0)
      <div class="top">
          <div class="relevant">
            <div class="title">相关用户</div>
            <div class="container-fluid list">
              @foreach($users as $user)
              <div class="col-xs-4">
                <a href="{{ route('users.show', $user) }}" target="_blank" class="avatar" >
                  <img src="{{ $user ->userinfo ->avatar }}">
                </a>
                <div class="info">
                  <a href="{{ route('users.show', $user) }}" target="_blank" class="name">{{ $user ->name }}</a>
                  <?php
                    $article_like_count = 0;
                    foreach ($user ->article as $key => $value) {
                      $article_like_count += $value ->articleZans_count;
                    }
                  ?>
                  <div class="meta">{{ $article_like_count }} 喜欢</div>
                </div>
              </div>
              @endforeach
            </div>
        </div>
      </div>

    @endif
    <!--  -->
    <div class="search-content">
      @if(count($articles))
      <div class="result">{{ $articles ->count() }} 个结果</div>
      <ul class="note-list">
        @foreach($articles as $article)
        <li>
          <!--  -->
          <div class="content">
            <!--  -->
            <div class="author">
              <a href="{{ route('users.show', $article ->user) }}" target="_blank" class="avatar" style="width: 24px;">
                <img src="{{ $article ->user ->userinfo ->avatar }}">
              </a>
              <div class="info">
                <a href="{{ route('users.show', $article ->user) }}" class="nickname">{{ $article ->user ->name }}</a>
                <span class="time">{{ $article ->updated_at }}</span>
              </div>
            </div>
            <!--  -->
            <a href="{{ route('articles.show', $article ) }}" class="title">{{ $article ->title }}</a>
            <!--  -->
            <p class="abstract">{{ $article ->abstract }}</p>
            <!--  -->
            <div class="meta">
              <a href="{{ route('articles.show', $article ) }}" target="_blank">
                <i class="glyphicon glyphicon-eye-open"></i> {{ $article ->visitors ->count() }}
              </a>
              <a href="{{ route('articles.show', $article ) }}" target="_blank">
                <i class="glyphicon glyphicon-comment"></i> {{ $article ->comment_count }}
              </a>
              <span>
                <i class="glyphicon glyphicon-heart"></i> {{ $article ->articleZans ->count() }}
              </span>
            </div>
          </div>
          <!--  -->
        </li>
        @endforeach
      </ul>
      @else
        @include('commons._empty')
      @endif
    </div>
  </div>
  <!--  -->
</div>
@endsection
