@if(count($users) > 0)
<div class="welcome_side welcome_side recommended-authors">
  <div class="section shadow auth-section">
    <div class="title">
      <span>推荐作者</span>
      <a class="page-change" href="{{ url('/') }}">
        <i class="glyphicon glyphicon-repeat"></i> 换一批
      </a>
    </div>
    <hr/>
    <ul class="list">
      <!--  -->

      @foreach($users as $user)
      <li>
        <a href="{{ route('users.show', $user) }}" target="_blank" class="avatar">
          <img src="{{ $user ->userinfo ->avatar }}" class="img-thumbnail"></a>
          @if(Auth::check() && Auth::id() !== $user->id)
          @if (!Auth::user()->isFollowing($user->id))
          <form action="{{ route('followers.store', $user->id) }}" method="post">
  	        {{ csrf_field() }}
  	        <button type="submit" class="follow" style="outline: 0 none; border: 0 none; background: none;"><i class="glyphicon glyphicon-plus"></i> <span>关注</span></button>
  	      </form>
          @else
          <form action="{{ route('followers.destroy', $user->id) }}" method="post">
  					{{ csrf_field() }}
  					{{ method_field('DELETE') }}
  					<button type="submit" class="follow" style="outline: 0 none; border: 0 none; background: none;"><i class="glyphicon glyphicon-minus"></i> <span>取消关注</span></button>
  				</form>
          @endif
          @endif
        </a>
        <a href="{{ route('users.show', $user) }}" target="_blank" class="name">
          {{ $user ->name }}
        </a>
        <?php
          $article_like_count = 0;
          foreach ($user  ->article as $key => $value) {
            $article_like_count += $value ->articleZans_count;
          }
        ?>
        <p> {{ $article_like_count }}喜欢</p>
      </li>
      @endforeach
      <!--  -->
    </ul>

    <!--  -->
    <a href="{{ route('users.index') }}" target="_blank" class="find-more">查看全部作者 <i class="glyphicon glyphicon-menu-right"></i></a>
  </div>
</div>
@endif
