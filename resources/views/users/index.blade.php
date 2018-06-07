@extends('layouts.app')

@section('content')
<div class="container recommend">
  <div class="row">
    <!--  -->
    @foreach($users as $user)
    @if(Auth::id() !== $user ->id)
    <div class="col-xs-3">
      <div class="wrap">
        <a target="_blank" href="{{ route('users.show', $user) }}">
          @if(!empty($user ->userinfo ->avatar))
          <img class="avatar" src="{{ $user ->userinfo ->avatar }}" alt="180">
          @else
          <img class="avatar" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="180">
          @endif
          <h4 class="name">{{ $user ->name }}</h4>
        </a>
        <p class="description">
          email: <span>{{ $user ->email }}</span>
        </p>
        @if (!Auth::user()->isFollowing($user->id))
        <form action="{{ route('followers.store', $user->id) }}" method="post">
	        {{ csrf_field() }}
	        <button type="submit" class="btn description-btn" style="outline: 0 none; border: 0 none;"><i class="glyphicon glyphicon-plus"></i> <span>点击关注作者</span></button>
	      </form>
        @else
        <form action="{{ route('followers.destroy', $user->id) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button type="submit" style="outline: 0 none; border: 0 none;" class="btn description-btn"><i class="glyphicon glyphicon-minus"></i> <span>取消关注</span></button>
				</form>
        @endif
        <hr>
        <div class="meta">最近更新</div>
        <div class="recent-update">
          <?php
            // 获取最近更新3条
            $updated_article = $user ->article() ->orderBy('updated_at') ->limit(3) ->get();
          ?>
          @if(count($updated_article) == 0)
            <p>作者太懒, 暂无文章更新~~</p>
          @else
            @foreach($updated_article as $article)
            <a class="new" target="_blank" href="{{ route('articles.show', $article) }}">{{ $article ->title }}</a>
            @endforeach
          @endif
        </div>
      </div>
    </div>
    @endif
    @endforeach
  </div>
</div>
@endsection
