@extends('layouts.app')

@section('content')
<div class="container subscription">
  <div class="row">
    <!--  -->
    <div class="aside">
      <ul class="js-subscription-list">
        <li class="">
          <a href="{{ route('categories.allKeep') }}" class="wrap">
            <div class="avatar">
              <img class="img-thumbnail" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg">
            </div>
            <div class="name">View圈子</div>
          </a>
        </li>
        <!--  -->
        @if(count($user ->followings) > 0)
          @foreach($user ->followings as $user)
          <li class="">
            <a href="{{ route('categories.allKeep', $user) }}" class="wrap">
              <div class="avatar">
                @if(!empty($user ->userinfo ->avatar))
                <img class="img-thumbnail" src="{{ $user ->userinfo ->avatar }}">
                @else
                <img class="img-thumbnail" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg">
                @endif
              </div>
              <div class="name">{{ $user ->name }}</div>
              <span class="count">{{ $user ->article ->count() }}</span>
            </a>
          </li>
          @endforeach
        @else
          <li>
            @include('commons._empty')
          </li>
        @endif
      </ul>
    </div>
    <!--  -->
    @if (!empty($auth))
    <div class="col-xs-16 col-xs-offset-8 main">
      <div>
        <div>
          <!--  -->
          <div class="main-top">
            <a href="{{ route('users.show', $auth) }}" target="_blank" class="avatar">
              @if(!empty($auth ->userinfo ->avatar))
              <img class="img-thumbnail" src="{{ $user ->userinfo ->avatar }}">
              @else
              <img class="img-thumbnail" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg">
              @endif
              <a href="{{ route('users.show', $auth) }}" target="_blank" class="btn btn-hollow">个人主页 <i class="iconfont ic-link"></i></a>
              <div class="title">
                <a href="" target="_blank" class="name">{{ $auth ->name }}</a>
                <i class="iconfont ic-woman"></i>
              </div>
              <?php
                $article_like_count = 0;
                foreach ($auth ->article as $key => $value) {
                  $article_like_count += $value ->articleZans_count;
                }
              ?>
              <div class="info">获得了{{ $article_like_count }}个喜欢</div>
            </div>
            <!--  -->
            <ul class="trigger-menu">
              <li class="active">
                <a href="{{ route('categories.allKeep', $auth) }}">
                  <i class="iconfont ic-articles"></i> 最新发布
                </a>
              </li>
            </ul>
            <!--  -->
            <ul class="note-list">
              @if(count($auth ->article) > 0)
                @foreach($auth ->article as $article)
                <li class="have-img">
                  <a href="" target="_blank" class="wrap-img">
                    <img src="{{ $article ->cover }}"></a>
                    <div class="content">
                      <a href="{{ route('articles.show', $article) }}" target="_blank" class="title">{{ $article ->title }}</a>
                      <p class="abstract">{{ $article ->abstract }}</p>
                      <div class="meta">
                        <a href="/p/97ecbd1af893" target="_blank">
                          <i class="glyphicon glyphicon-eye-open"></i> 0
                        </a>
                        <a href="/p/97ecbd1af893#comments" target="_blank">
                          <i class="glyphicon glyphicon-comment"></i> 0
                        </a>
                        <span>
                          <i class="glyphicon glyphicon-heart"></i> 0
                        </span>
                        <span class="time"></span>
                      </div>
                    </div>
                  </li>
                  @endforeach
                @else
                  @include('commons._empty')
                @endif
                <!--  -->
            </ul>
        </div>
      </div>
    </div>
    @endif

    @if (empty($auth))
    <div class="col-xs-16 col-xs-offset-8 main">
      <div>
        <ul class="note-list">
          <!--  -->
          @if(count($articleZans) > 0)
          @foreach($articleZans as $articleZan)
          <li class="have-img">
            <a href="{{ route('articles.show', $articleZan ->article) }}" target="_blank" class="wrap-img">
              @if(!empty($articleZan ->article ->cover))
              <img src="{{ $articleZan ->article ->cover }}"></a>
              @endif
              <div class="content">
                <div class="author">

                  <a href="/u/e4c422aa5418" target="_blank" class="avatar" style="width: 24px;">
                    @if(!empty($articleZan ->user ->userinfo ->avatar))
                    <img src="{{ $articleZan ->user ->userinfo ->avatar }}">
                    @else
                    <img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="">
                    @endif
                  </a>

                  <div class="info">
                    <a href="{{ route('users.show', $articleZan ->user) }}" target="_blank" class="nickname">{{ $articleZan ->user ->name }}</a>
                    <span>喜欢了文章 · {{ $articleZan ->article ->title }}</span>
                  </div>
                </div>
                <a href="{{ route('articles.show', $articleZan ->article) }}" target="_blank" class="title">{{ $articleZan ->article ->title }}</a>
                <p class="abstract">{{ $articleZan ->article ->abstract }}</p>
                <div class="meta">
                  <div class="origin-author">
                    <a href="{{ route('users.show', $articleZan ->user) }}" target="_blank">
                      <i class="glyphicon glyphicon-user"></i> {{ $articleZan ->article ->user ->name }}
                    </a>
                  </div>
                  <a href="{{ route('articles.show', $articleZan ->article) }}" target="_blank">
                    <i class="glyphicon glyphicon-comment"></i> {{ $articleZan ->article ->comment_count }}
                  </a>
                  <span>
                    <i class="glyphicon glyphicon-heart"></i> {{ $articleZan ->article ->articleZans ->count() }}
                  </span>
                </div>
              </div>
            </li>
            @endforeach
            @else
              @include('commons._empty')
            @endif
           <!--  -->
        </ul>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection
