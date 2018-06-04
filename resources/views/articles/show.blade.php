@extends('layouts.app')

@section('content')
<div class="container index">
  <div class="row">
    @include('commons._message')

    <!--  -->
    <div class="col-xs-8 main note">
      <div class="post">
        <!-- 文章信息 -->
        <div class="article">
          <!--  -->
          <h1 class="title">{{ $article ->title }}</h1>

          <!-- 作者信息  -->
          <div class="author">
            <a class="avatar" href="/u/7f7a600b9bcc">
              <img src="//upload.jianshu.io/users/upload_avatars/8778234/808e1c59-0e4b-4245-b8ed-5e3dc24811c6.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96" alt="96">
            </a>
            <div class="info">
              <span class="name"><a href="/u/7f7a600b9bcc">{{ $article ->user ->name }}</a></span>
              @if(!(Auth::id() == $article ->user ->id))
                @if (!Auth::user()->isFollowing($article ->user->id))
                <form action="{{ route('followers.store', $article ->user->id) }}" method="post" style="display: inline-block;">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-success follow" style="outline: 0 none; border: 0 none;"><i class="glyphicon glyphicon-plus"></i> <span>关注</span></button>
                </form>
                @else
                <form action="{{ route('followers.destroy', $article ->user->id) }}" method="post" style="display: inline-block;">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" style="outline: 0 none; border: 0 none;" class="btn btn-success follow"><i class="glyphicon glyphicon-minus"></i> <span>取消关注</span></button>
                </form>
                @endif
              @endif
              <div class="meta">
                <span class="publish-time" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">{{ $article -> updated_at }}</span>
                <span class="views-count">阅读 2721</span>
                <span class="comments-count">评论 {{ $article ->comment_count }}</span>
                <span class="likes-count">喜欢 100</span>
              </div>
            </div>

            @if(Auth::id() == $article ->user ->id)
              <a href="{{ route('articles.edit', $article) }}" target="_blank" class="edit">编辑文章</a>
            @endif
          </div>

          <!--  -->
          <div class="show-content">
            <div class="show-content-free">
              {!! $article ->body !!}
            </div>
          </div>
        </div>

        <!-- 底部作者信息 -->
        <div class="follow-detail">
          <div class="info">
            <a class="avatar" href="/u/8b53247b62e4">
              <img src="//upload.jianshu.io/users/upload_avatars/3963720/c5607f36f556.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96" alt="96">
            </a>
            @if(!(Auth::id() == $article ->user ->id))
              @if (!Auth::user()->isFollowing($article ->user->id))
              <form action="{{ route('followers.store', $article ->user->id) }}" method="post" style="">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success follow" style="outline: 0 none; border: 0 none;"><i class="glyphicon glyphicon-plus"></i> <span>关注</span></button>
              </form>
              @else
              <form action="{{ route('followers.destroy', $article ->user->id) }}" method="post" style="">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" style="outline: 0 none; border: 0 none;" class="btn btn-success follow"><i class="glyphicon glyphicon-minus"></i> <span>取消关注</span></button>
              </form>
              @endif
            @endif
            <a class="title" href="/u/8b53247b62e4">{{ $article ->user ->name }}</a>
            <p>被 63857 人关注，获得了 7253 个喜欢</p></div>
            <div class="signature">家有二宝，46岁又当妈。热爱生活，热爱家庭，热爱看书，相信"腹有诗书气自华"个人微信号lh15399687152</div>
        </div>

        <!-- 底部操作 -->
        @if(Auth::id() !== $article ->user ->id)
        <div class="meta-bottom clearfix">
            <div class="like">
              <div class="like-group">
                <div class="btn-like">
                  @if(!$article -> articleZan(Auth::id()) -> exists())
                  <a href="{{ route('articles.zan', $article) }}">喜欢</a>
                  @else
                  <a href="{{ route('articles.unzan', $article) }}">取消喜欢</a>
                  @endif
                </div>
                <div class="modal-wrap">
                  <a>0</a>
                </div>
              </div>
            </div>

            <div class="like">
              <div class="like-group">
                <div class="btn-like">
                  @if(!$article -> articleCollect(Auth::id()) -> exists())
                  <a href="{{ route('articles.collect', $article) }}">收藏</a>
                  @else
                  <a href="{{ route('articles.uncollect', $article) }}">取消收藏</a>
                  @endif
                </div>
                <div class="modal-wrap">
                  <a>0</a>
                </div>
              </div>
            </div>
        </div>
        @endif

        <!-- 评论 -->
        <div class="" style="margin-top: 50px;">
          <div id="comment-list" class="comment-list">
            @includeWhen(Auth::check(), 'comments.index')

            <div class="normal-comment-list" id="normal-comment-list">
              <div>
                <div>
                  <div class="top-title">
                    <span>{{ $article ->comment ->count() }}条评论</span>
                    <a class="author-only" href="{{ route('articles.show', ['id' => $article ->id, 'look' => 'author']) }}">只看作者</a>
                    <a class="close-btn" href="{{ route('articles.show', ['id' => $article ->id, 'look' => 'none']) }}">关闭评论</a>
                    <div class="pull-right">
                      <a class="" href="{{ route('articles.show', ['id' => $article ->id, 'order_by' => 'asc']) }}">按时间正序</a>
                      <a class="active" href="{{ route('articles.show', ['id' => $article ->id, 'order_by' => 'desc']) }}">按时间倒序</a>
                    </div>
                  </div>
                </div>

                @includeWhen(Auth::check(), 'comments.list', ['comments' => $comments])
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
    <!--  -->
    <div class="col-xs-4 aside">
      <div class="board">

      </div>
    </div>
  </div>
</div>
@endsection
