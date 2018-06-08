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

          <!-- 文章标签 -->
          <div class="">
            <ul class="tag-list clearfix">
              @foreach($article ->tag as $tag)
              <li class="tag-item">
                <a href="#">{{ $tag ->tag_name }}</a>
              </li>
              @endforeach
            </ul>
          </div>

          <!-- 作者信息  -->
          <div class="author">
            <a class="avatar" href="/u/7f7a600b9bcc">
              @if(empty($article ->user ->userinfo ->avatar))
              <img class="img-thumbnail" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="120">
              @else
              <img class="img-thumbnail" src="{{ $article ->user ->userinfo ->avatar }}" alt="120">
              @endif
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
                <span class="views-count">阅读 {{ $article->visitors_count }}</span>
                <span class="comments-count">评论 {{ $article ->comment_count }}</span>
                <span class="likes-count">喜欢 {{ $article ->articleZans_count }}</span>
              </div>
            </div>

            @if(Auth::id() == $article ->user ->id)
              <a href="{{ route('articles.edit', $article) }}" target="_blank" class="edit"><i class="glyphicon glyphicon-pencil"></i> 编辑文章</a>
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
              @if(empty($article ->user ->userinfo ->avatar))
              <img class="img-thumbnail" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="120">
              @else
              <img class="img-thumbnail" src="{{ $article ->user ->userinfo ->avatar }}" alt="120">
              @endif
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
            <p>被 {{ $article ->user ->followers() ->count() }} 人关注，获得了 {{ $article ->articleZans_count }} 个喜欢</p></div>
            @if(empty($article ->user ->userinfo ->introduction))
            <div class="signature">这家伙很懒什么也没留下~~</div>
            @else
            <div class="signature">{{ $article ->user ->userinfo ->introduction }}</div>
            @endif
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
                  <a>{{ $article ->articleZans_count }}</a>
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
                  <a>{{ $article ->articleCollects_count }}</a>
                </div>
              </div>
            </div>
        </div>
        @endif

        <!-- 评论 -->
        <div class="" style="margin-top: 50px;">
          <div id="main-comment" class="comment-list">
            @includeWhen(Auth::check(), 'comments.index')

            <div class="normal-comment-list" id="normal-comment-list">
              <div>
                <div>
                  <div class="top-title">
                    <span>{{ $article ->comment_count }}条评论</span>
                    <a class="author-only" href="{{ route('articles.show', ['id' => $article ->id, 'look' => 'author']) }}">只看作者</a>
                    <a class="close-btn" href="{{ route('articles.show', ['id' => $article ->id, 'look' => 'none']) }}">关闭评论</a>
                    <div class="pull-right">
                      <a class="" href="{{ route('articles.show', ['id' => $article ->id, 'order_by' => 'asc']) }}">按时间正序</a>
                      <a class="active" href="{{ route('articles.show', ['id' => $article ->id, 'order_by' => 'desc']) }}">按时间倒序</a>
                    </div>
                  </div>

                  <!-- 没有评论 -->
                  @if($article ->comment_count == 0)
                    @include('comments.empty');
                  @endif
                </div>




                <!-- 无限极评论 -->
                <div class="comment js_comment_box">
                  <!--  -->
                  @includeWhen(Auth::check(), 'comments.list', ['comments' => $article ->comment])
                  <!--  -->
                </div>



              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!--  -->
    <div class="col-xs-4 aside">
      <div class="board">
        <!-- 关于作者 -->
        <div class="sidebar-block user-block">
          <header data-v-2b9fe4cd="" class="user-block-header">关于作者</header>
          <div class="block-body">
            <ul class="user-list">
              <li class="item">
                <a href="{{ route('users.show',  $article ->user) }}" target="_blank" rel="" class="link">
                  <div class="lazy avatar avatar loaded" title="">
                    @if(!empty($article ->user ->userinfo ->avatar))
                    <img src="{{$article ->user ->userinfo ->avatar}}" alt="">
                    @else
                    <img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="">
                    @endif
                  </div>
                  <div class="user-info">
                    <div class="username">{{ $article ->user ->name }}</div>
                    <div class="position">@if(!empty($article ->user ->userinfo ->introduction)) {{ $type_article ->user ->introduction }} @endif</div>
                  </div>
                </a>
              </li>
            </ul>
            <div class="" style="padding: 0rem 2.6rem .8rem 2.6rem;">
              <p style="margin-bottom: 15px;">他写过 {{ count($article ->user ->article) }} 篇文章</p>
              <?php
                $article_like_count = 0;
                foreach ($article ->user  ->article as $key => $value) {
                  $article_like_count += $value ->articleZans_count;
                }
              ?>
              <p style="margin-bottom: 15px;">他收获到 {{ $article_like_count }} 个喜欢</p>
            </div>
          </div>
        </div>

        <!-- 标签云 -->
        @if (count($tags))
        <div class="sidebar-block user-block">
          <header data-v-2b9fe4cd="" class="user-block-header">标签云</header>
          <ul class="tag-list clearfix" style="padding: 0 2.6rem;">
            @foreach($tags as $tag)
            <li class="tag-item">
              <a href="#">{{ $tag ->tag_name }}</a>
            </li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- 他写过的相关文章 -->
        @if (count($type_articles))
        <div class="sidebar-block user-block">
          <header data-v-2b9fe4cd="" class="user-block-header">他写过的相关文章</header>
          <ul class="user-list">
            <!--  -->
            @foreach($type_articles as $type_article)
            <li class="item">
              <a href="{{ route('articles.show', $type_article) }}" target="_blank" class="item" >
                <div class="entry-title">{{ $type_article ->title }}</div>
                <div class="entry-meta-box">
                  <div class="entry-meta">
                    <i class="glyphicon glyphicon-heart"></i>
                    <span class="count">{{ $type_article ->articleZans_count }}</span>
                  </div>

                  <div class="entry-meta">
                    <i class="glyphicon glyphicon-comment"></i>
                    <span class="count">{{ $type_article ->comment_count }}</span>
                  </div>
                </div>
              </a>
            </li>
            @endforeach
            <!--  -->
          </ul>
        </div>
        @endif
        <!--  -->

        <!-- 相关文章推荐 -->
        @if (count($type_articles))
        <div class="sidebar-block user-block">
          <header data-v-2b9fe4cd="" class="user-block-header">相关文章推荐</header>
          <ul class="user-list">
            <!--  -->
            @foreach($type_articles as $type_article)
            <li class="item">
              <a href="{{ route('articles.show', $type_article) }}" target="_blank" class="item" >
                <div class="entry-title">{{ $type_article ->title }}</div>
                <div class="entry-meta-box">
                  <div class="entry-meta">
                    <i class="glyphicon glyphicon-heart"></i>
                    <span class="count">{{ $type_article ->articleZans_count }}</span>
                  </div>

                  <div class="entry-meta">
                    <i class="glyphicon glyphicon-comment"></i>
                    <span class="count">{{ $type_article ->comment_count }}</span>
                  </div>
                </div>
              </a>
            </li>
            @endforeach
            <!--  -->
          </ul>
        </div>
        @endif
        <!--  -->

        <!-- 文章浏览排行 -->
        @inject('articlePresenter','App\Presenters\ArticlePresenter')
        <?php  $hotArticleList = $articlePresenter->hotArticleList(); ?>
        @if(count($hotArticleList))
        <div class="sidebar-block user-block">
          <header class="user-block-header">文章浏览排行</header>
          <ul class="user-list">
            @foreach($hotArticleList as $article)
            <li class="item">
              <a href="{{ route('articles.show', $type_article) }}" target="_blank" class="item" >
                <div class="entry-title">{{ $article ->title }}</div>
                <div class="entry-meta-box">
                  <div class="entry-meta">
                    <i class="glyphicon glyphicon-heart"></i>
                    <span class="count">{{ $article ->articleZans_count }}</span>
                  </div>

                  <div class="entry-meta">
                    <i class="glyphicon glyphicon-comment"></i>
                    <span class="count">{{ $article ->comment_count }}</span>
                  </div>
                </div>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- 活跃用户 -->
        @if (count($active_users))
        <div class="sidebar-block user-block">
          <header class="user-block-header">最近活跃用户</header>
          <ul class="user-list">
            @foreach ($active_users as $active_user)
              <li class="item">
                <a href="{{ route('users.show', $active_user ->id) }}" target="_blank" class="link">
                  <div title="" class="lazy avatar avatar loaded">
                    @if(!empty($active_user ->userinfo ->avatar))
                    <img src="{{$active_user ->userinfo ->avatar}}" alt="">
                    @else
                    <img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="">
                    @endif
                  </div>
                  <div class="user-info">
                    <div class="username">{{ $active_user ->name }}</div>
                    <div class="position"></div>
                  </div>
                </a>
              </li>
            @endforeach
           </ul>
        </div>
        @endif
        <!--  -->

        <!-- 相关资源推荐 -->
        @if(count($links))
        <div class="sidebar-block user-block">
          <header class="user-block-header">相关学习资源推荐</header>
          <ul class="user-list">
            @foreach($links as $link)
            <li class="item">
              <a href="{{ $link ->link }}" target="_blank" class="link" style="color: #333;">{{ $link ->title }}</a>
            </li>
            @endforeach
          </ul>
        </div>
        @endif

      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/comment.js') }}"></script>

<script type="text/x-template" id="js_top_comment_tel">
  <div class="comments" data-user_id="{user_id}" data-parent_id="{parent_id}" data-article_id="{article_id}" data-comment_id="{comment_id}">
    <div>
      <div class="author">
        <div class="v-tooltip-container" style="z-index: 0;">
          <div class="v-tooltip-content">
            <a href="#" target="_blank" class="avatar">
              <img src="//upload.jianshu.io/users/upload_avatars/2125509/e3ce54eb-75e0-49a3-a084-06e7b1dfb08e.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/114/h/114">
            </a>
          </div>
        </div>
        <div class="info">
          <a href="#" target="_blank" class="name">{user_name}</a>
          <div class="meta">
            <span>{created_at}</span>
          </div>
        </div>
      </div>
      <div class="comment-wrap">
        <p>{body}</p>
        <div class="tool-group">
          <a class="like-button">
            <i class="glyphicon glyphicon-thumbs-up"></i>
            <span>赞</span>
          </a>
          <a class="js_sub_show" style="cursor: pointer;">
            <i class="glyphicon glyphicon-comment"></i> <span>回复</span>
          </a>
          <a class="report">
            <i class="glyphicon glyphicon-remove"></i>
            <span>举报</span>
          </a>
        </div>
      </div>
    </div>

    <div class="sub-comment-list">
      <div>
        <form class="new-comment" style="display: none;">
          <textarea placeholder="写下你的评论..."></textarea>
          <div class="write-function-block">
            <a class="btn btn-send js_sub_send" data-user_id="{user_id}" data-parent_id="{parent_id}" data-article_id="{article_id}" data-comment_id="{comment_id}">发送</a>
            <a class="cancel">取消</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</script>

<script type="text/x-template" id="js_sub_comment_tel">
  <div class="sub-comment">
    <p>
      <div class="v-tooltip-container" style="z-index: 0;">
        <div class="v-tooltip-content">
          <a href="#" target="_blank">{user_name}</a>：
        </div>
      </div>
      <span>{body}</span>
    </p>
    <div class="sub-tool-group">
      <span>{created_at}</span>
      <a class="js_num_comment">
        <i class="iconfont ic-comment"></i>
        <span>回复</span>
      </a>
      <a class="subcomment-delete">
        <span>删除</span>
      </a>
    </div>
  </div>
</script>

<script type="text/javascript">
  (function ($) {
    var article = {
      initFunction: function () {
        // 无限极评论初始化
        $('#main-comment').comment();
      }
    }

    article.initFunction();
  }(jQuery));
</script>
@endsection
