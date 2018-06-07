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
                <span class="views-count">阅读 {{ count($article->visitors) }}</span>
                <span class="comments-count">评论 {{ $article ->comment_count }}</span>
                <span class="likes-count">喜欢 {{ $article ->articleZans($article ->user ->id) ->count() }}</span>
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

        <!-- 分享 -->
        <div class="bdsharebuttonbox" data-tag="share_1">
        	<a class="bds_mshare" data-cmd="mshare"></a>
        	<a class="bds_qzone" data-cmd="qzone" href="#"></a>
        	<a class="bds_tsina" data-cmd="tsina"></a>
        	<a class="bds_baidu" data-cmd="baidu"></a>
        	<a class="bds_renren" data-cmd="renren"></a>
        	<a class="bds_tqq" data-cmd="tqq"></a>
        	<a class="bds_more" data-cmd="more">更多</a>
        	<a class="bds_count" data-cmd="count"></a>
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
            <p>被 {{ $article ->user ->followers() ->count() }} 人关注，获得了 {{ $article ->articleZans($article ->user ->id) ->count() }} 个喜欢</p></div>
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
                  <a>{{ $article ->zan_count }}</a>
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

                  <!-- 没有评论 -->
                  @if($article ->comment ->count() == 0)
                    @include('comments.empty');
                  @endif
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
              <p style="margin-bottom: 15px;">他写过 0 篇文章</p>
              <p style="margin-bottom: 15px;">他收获到 0 个喜欢</p>
            </div>
          </div>
        </div>

        <!-- 你可能感兴趣的人 -->
        @if (count($type_articles))
        <div class="sidebar-block user-block">
          <header data-v-2b9fe4cd="" class="user-block-header">你可能感兴趣的人</header>
          <ul class="user-list">
            <!--  -->
            @foreach($type_articles as $type_article)
            @if( $type_article ->user_id !== Auth::id() )
            <li class="item">
              <a href="{{ route('users.show',  $type_article ->user) }}" target="_blank" rel="" class="link">
                <div class="lazy avatar avatar loaded" title="">
                  @if(!empty($type_article ->user ->userinfo ->avatar))
                  <img src="{{$type_article ->user ->userinfo ->avatar}}" alt="">
                  @else
                  <img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="">
                  @endif
                </div>
                <div class="user-info">
                  <div class="username">{{ $type_article ->user ->name }}</div>
                  <div class="position">@if(!empty($type_article ->user ->userinfo ->email)) {{ $type_article ->user ->email }} @endif</div>
                </div>
              </a>
            </li>
            @endif
            @endforeach
            <!--  -->
          </ul>
        </div>
        @endif

        <!-- 他写过的相关文章 -->
        @if (count($auth_articles))
        <div class="sidebar-block user-block">
          <header data-v-2b9fe4cd="" class="user-block-header">他写过的相关文章</header>
          <ul class="user-list">
            <!--  -->
            @foreach($auth_articles as $type_article)
            <li class="item">
              <a href="{{ route('articles.show', $type_article) }}" target="_blank" class="item" >
                <div class="entry-title">{{ $type_article ->title }}</div>
                <div class="entry-meta-box">
                  <div class="entry-meta">
                    <i class="glyphicon glyphicon-heart"></i>
                    <span class="count">{{ $type_article ->articleZans($type_article ->user ->id) ->count() }}</span>
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
                    <span class="count">{{ $type_article ->articleZans($type_article ->user ->id) ->count() }}</span>
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
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
	window._bd_share_config = {
    common : {
			bdText : '自定义分享内容',
			bdDesc : '自定义分享摘要',
			bdUrl : '自定义分享url地址',
			bdPic : '自定义分享图片'
		},
		share : [{
			"bdSize" : 16
		}],
		slide : [{
			bdImg : 0,
			bdPos : "right",
			bdTop : 100
		}],
		image : [{
			viewType : 'list',
			viewPos : 'top',
			viewColor : 'black',
			viewSize : '16',
			viewList : ['qzone','tsina','huaban','tqq','renren']
		}],
		selectShare : [{
			"bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
		}]
	}

	//以下为js加载部分
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
@endsection
