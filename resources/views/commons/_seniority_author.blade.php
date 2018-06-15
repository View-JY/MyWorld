@if(count($seniorities) > 0)
<div class="welcome_side welcome_side recommended-authors">
  <div class="section shadow auth-section">
    <div class="title">
      <span>作者排行</span>
    </div>
    <hr/>
    <ul class="list">
      <!--  -->
      @foreach($seniorities as $key => $seniority)
      <li class="clearfix">
        <span class="author-num pull-left">
          <strong class="badge">{{ $key + 1 }}</strong>
        </span>

        <a href="" target="_blank" class="avatar">
          <img src="{{ $seniority ->userinfo ->avatar }}" class="img-thumbnail"></a>
          <!--  -->
          @if(Auth::check() && Auth::id() !== $seniority->id)
          @if (!Auth::user()->isFollowing($seniority->id))
          <form action="{{ route('followers.store', $seniority->id) }}" method="post">
  	        {{ csrf_field() }}
  	        <button type="submit" class="follow" style="outline: 0 none; border: 0 none; background: none;"><i class="glyphicon glyphicon-plus"></i> <span>关注</span></button>
  	      </form>
          @else
          <form action="{{ route('followers.destroy', $seniority->id) }}" method="post">
  					{{ csrf_field() }}
  					{{ method_field('DELETE') }}
  					<button type="submit" class="follow" style="outline: 0 none; border: 0 none; background: none;"><i class="glyphicon glyphicon-minus"></i> <span>取消关注</span></button>
  				</form>
          @endif
          @endif
          <!--  -->
        </a>
        <a href="{{ route('users.show', $seniority) }}" target="_blank" class="name">
          {{ $seniority ->name }}
        </a>
        <?php
          $article_like_count = 0;
          foreach ($seniority  ->article as $key => $value) {
            $article_like_count += $value ->articleZans_count;
          }
        ?>
        <p> {{ $article_like_count }}喜欢</p>
      </li>
      @endforeach
      <!--  -->
    </ul>
  </div>
</div>
@endif
