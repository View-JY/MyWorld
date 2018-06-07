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
          <a class="name" href="/u/606f73047662">{{ $user ->name }}</a>
        </div>
        <div class="info">
          <ul>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="/u/606f73047662">
                  <p>{{ count($user ->followings) }}</p>
                  关注 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="/u/606f73047662">
                  <p>{{ count($user ->followers) }}</p>
                  粉丝 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="/u/606f73047662">
                  <p>{{ count($user ->article) }}</p>
                  文章 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
            <!--  -->
            <li>
              <div class="meta-block">
                <a href="/u/606f73047662">
                  <?php
                    $article_like_count = 0;
                    foreach ($user ->article as $key => $value) {
                      $article_like_count += $value ->articleZans($user ->id) ->count();
                    }
                  ?>
                  <p>{{ $article_like_count }}</p>
                  收获喜欢 <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </div>
            </li>
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
      </ul>

      <!--  -->
      <div class="list-container">
        <!-- 我的评论 -->
        <ul class="note-list">
        @if(if_query('type', 'comment'))

          @foreach($user ->comment as $comment)
          <li id="feed-309860748">
            <div class="content">
              <div class="author">
                <a class="avatar" href="{{ route('users.show', $comment ->user) }}" style="width: 24px;">
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
                    <i class="glyphicon glyphicon-eye-open"></i> {{ $comment ->article ->visitors ->count() }}
                  </a>
                  <a href="{{ route('articles.show', $comment ->article) }}">
                    <i class="glyphicon glyphicon-comment"></i> {{ $comment ->article ->comment_count }}
                  </a>
                  <span><i class="glyphicon glyphicon-heart"></i> {{ $comment ->article ->articleZans($comment ->article ->user ->id) ->count() }}</span>
                </div>
              </blockquote>
            </div>
          </li>
          @endforeach

        @else
        <!-- 我的文章 -->

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
                  <i class="glyphicon glyphicon-eye-open"></i> {{ $article ->visitors ->count() }}
                </a>
                <a target="_blank" href="{{ route('articles.show', $article) }}">
                  <i class="glyphicon glyphicon-comment"></i> {{ $article ->comment_count }}
                </a>
                <span><i class="glyphicon glyphicon-heart"></i> {{ $article ->articleZans($user ->id) ->count() }}</span>
                <span class="time">{{ $article ->updated_at }}</span>
              </div>
            </div>
          </li>
          @endforeach

        @endif
        </ul>
      </div>
    </div>

    <!-- Right -->
    <div class="col-xs-4 aside">
      <div class="">
        <!-- 文集 -->
        <div>
          <div class="title">我的文集</div>
          <div class="new-collection-block"><a href="{{ route('works.create') }}" class="new-collection-btn"><i class="glyphicon glyphicon-plus"></i> <span>创建一个新文集</span></a></div>
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
