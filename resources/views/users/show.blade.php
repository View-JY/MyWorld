@extends('layouts.app')

@section('content')
<div class="container person">
  <div class="row">
    <!-- Left -->
    <div class="col-xs-8 main" style="background-color: #FFF; padding-top: 20px;">
      <div class="main-top clearfix">
        <a class="avatar" href="/u/606f73047662">
          <img src="{{ $user ->userinfo ->avatar }}" alt="240" class="img-thumbnail" />
        </a>
        <div class="title">
          <a class="name" href="/u/606f73047662">{{ $user ->name }}</a>
        </div>
        <div class="info">
          <ul>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="{{ route('users.show', [$user ->id, 'type' =>'follower']) }}">
                  <p>{{ $user ->followings_count }}</p>
                  关注 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="{{ route('users.show', [$user ->id, 'type' =>'fans']) }}">
                  <p>{{ $user ->followers_count }}</p>
                  粉丝 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="{{ route('users.show', [$user ->id]) }}">
                  <p>{{ $user ->article_count }}</p>
                  文章 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="javascript:;">
                  <?php
                    $article_like_count = 0;
                    foreach ($user ->article as $key => $value) {
                      $article_like_count += $value ->articleZans_count;
                    }
                  ?>
                  <p>{{ $article_like_count }}</p>
                  收获喜欢
                </a>
              </div>
            </li>
            <!--  -->
          </ul>
        </div>

        <!-- 个人资料入口 -->
        @if(Auth::id() == $user ->id)
        <a href="{{ route('users.edit', $user) }}" class="setting-btn" style="text-align: center; line-height: 30px;">编辑个人资料</a>
        @endif
      </div>

      <!--  -->
      <ul class="trigger-menu">
        <li class="{{ active_class(active_class(if_query('type', null))) }}">
          <a href="{{ route('users.show', [$user ->id]) }}">
            <i class="glyphicon glyphicon-file"></i> 我的文章
          </a>
        </li>
        <li class="{{ active_class(active_class(if_query('type', 'comment'))) }}">
          <a href="{{ route('users.show', [$user ->id, 'type' =>'comment']) }}">
            <i class="glyphicon glyphicon-comment"></i> 我的评论
          </a>
        </li>
        <li class="{{ active_class(active_class(if_query('type', 'follower'))) }}">
          <a href="{{ route('users.show', [$user ->id, 'type' =>'follower']) }}">
            <i class="glyphicon glyphicon-plus"></i> 我的关注
          </a>
        </li>
        <li class="{{ active_class(active_class(if_query('type', 'fans'))) }}">
          <a href="{{ route('users.show', [$user ->id, 'type' =>'fans']) }}">
            <i class="glyphicon glyphicon-heart"></i> 我的粉丝
          </a>
        </li>
      </ul>

      <!--  -->
      <div class="list-container">
        <!-- 我的评论 -->
        <ul class="note-list">
        @if(if_query('type', 'comment'))

          @if(count($user ->comment) > 0)
            @foreach($user ->comment as $comment)
            <li id="feed-309860748">
              <div class="content">
                <div class="author">
                  <a class="avatar" href="{{ route('users.show', $comment ->user) }}" style="width: 24px; height: 24px;">
                    <img src="{{ $comment ->user ->userinfo ->avatar }}" alt="180">
                  </a>
                  <div class="info">
                    <a class="nickname" href="{{ route('users.show', $comment ->user) }}">{{ $comment ->user ->name }}</a>
                    <span data-type="comment_note"> 发表了评论 · {{ $comment ->created_at }}</span>
                  </div>1
                </div>

                <p class="comment">{{ $comment ->body }}</p>

                <blockquote>
                  <a class="title" href="{{ route('articles.show', $comment ->article) }}">{{ $comment ->article ->title }}</a>
                  <p class="abstract">{!! $comment ->article ->abstract !!}</p>

                  <div class="meta">
                    <div class="origin-author">
                      <a href="{{ route('articles.show', $comment ->article) }}">{{ $comment ->article ->user ->name }}</a>
                    </div>
                    <a href="{{ route('articles.show', $comment ->article) }}">
                      <i class="glyphicon glyphicon-eye-open"></i> {{ $comment ->article ->visitors_count }}
                    </a>
                    <a href="{{ route('articles.show', $comment ->article) }}">
                      <i class="glyphicon glyphicon-comment"></i> {{ $comment ->article ->comment_count }}
                    </a>
                    <span><i class="glyphicon glyphicon-heart"></i> {{ $comment ->article ->articleZans ->count()  }}</span>
                  </div>
                </blockquote>
              </div>
            </li>
            @endforeach
          @else
            <li>
              @include('commons._empty')
            </li>
          @endif

        @elseif(if_query('type', 'follower'))
          <!-- 我的关注  -->
          @if(count($user ->followings) > 0)
            @foreach($user ->followings as $following)
            <li class="clearfix">
              <a class="avatar" href="/u/1441f4ae075d" style="width: 52px; height: 52px;">
                <img src="{{ $following ->userinfo ->avatar }}" alt="180">
              </a>
              <div class="info">
                <a class="name" href="{{ route('users.show', $following ) }}">{{ $following ->name }}</a>
                <div class="meta">
                  <span>关注 {{ $following ->followings-> count() }}</span><span>粉丝 {{ $following ->followers-> count() }}</span><span>文章 {{ $following ->article-> count() }}</span>
                </div>
                <div class="meta">
                  @if($following ->userinfo ->introduction)
                  <p>{{ $following ->userinfo ->introduction }}</p>
                  @else
                  <p>这家伙很懒,什么都没留下</p>
                  @endif
                </div>
              </div>
            </li>
            @endforeach
          @else
            <li>
              @include('commons._empty')
            </li>
          @endif

        @elseif(if_query('type', 'fans'))
          <!-- 我的粉丝  -->
          @if(count($user ->followers) > 0)
            @foreach($user ->followers as $follower)
            <li class="clearfix">
              <a class="avatar" href="/u/1441f4ae075d" style="width: 52px; height: 52px;">
                <img src="{{ $follower ->userinfo ->avatar }}" alt="180">
              </a>
              <div class="info">
                <a class="name" href="{{ route('users.show', $follower ) }}">{{ $follower ->name }}</a>
                <div class="meta">
                  <span>关注 {{ $follower ->followings-> count() }}</span><span>粉丝 {{ $follower ->followers-> count() }}</span><span>文章 {{ $follower ->article-> count() }}</span>
                </div>
                <div class="meta">
                  <p>{{ $follower ->userinfo ->introduction }}</p>
                </div>
              </div>
            </li>
            @endforeach
          @else
            <li>
              @include('commons._empty')
            </li>
          @endif
        @else
        <!-- 我的文章 -->
          @if(count($user ->followers) > 0)
            <?php
              $articles = $user ->article() ->where([]) ->orderBy('created_at', 'desc') ->get();
            ?>

            @foreach($articles as $article)
            <li>
              <div class="content">
                <a class="title" target="_blank" href="{{ route('articles.show', $article) }}">{{ $article ->title }}</a>
                <p class="abstract">
                  {!! $article ->abstract !!}
                </p>
                <div class="meta">
                  <a target="_blank" href="{{ route('articles.show', $article) }}">
                    <i class="glyphicon glyphicon-eye-open"></i> {{ $article ->visitors_count }}
                  </a>
                  <a target="_blank" href="{{ route('articles.show', $article) }}">
                    <i class="glyphicon glyphicon-comment"></i> {{ $article ->comment_count }}
                  </a>
                  <span><i class="glyphicon glyphicon-heart"></i> {{ $article ->articleZans_count }}</span>
                  <span class="time">{{ $article ->updated_at }}</span>
                </div>
              </div>
            </li>
            @endforeach
          @else
            <li>
              @include('commons._empty')
            </li>
          @endif
        @endif
        </ul>
      </div>
    </div>

    <!-- Right -->
    <div class="col-xs-4 aside">
      <div class="">
        <!-- 个人介绍 -->
        <div class="">
          <h5><strong>个人介绍</strong></h5>
          @if($user ->userinfo ->introduction)
          <p>{{ $user ->userinfo ->introduction }}</p>
          @else
          <p>这家伙和很懒什么都没留下</p>
          @endif
          <hr>
          <h5><strong>最后活跃</strong></h5>
          <p title="{{  $user->last_actived_at }}">{{ $user->last_actived_at->diffForHumans() }}</p>
          <hr>
        </div>

        <!-- 注册登录时间 -->
        <div class="">
          <h5><strong>注册于</strong></h5>
          <p>{{ $user ->created_at ->diffForHumans() }}</p>
          <hr>
        </div>

        <!-- 文集 -->
        <div>
          <h5><strong>我的文集</strong></h5>
          @if(Auth::id() == $user ->id)
          <div class="new-collection-block"><a href="{{ route('works.create') }}" class="new-collection-btn"><i class="glyphicon glyphicon-plus"></i> <span>创建一个新文集</span></a></div>
          @endif
          <ul class="list">
            @foreach($works as $work)
            <li>
              <a href="{{ route('works.show', $work) }}" target="_blank" class="name"><i class="glyphicon glyphicon-book"></i> 《{{ $work ->name }}》</a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
