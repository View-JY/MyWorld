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
          <img src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96"></a> <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注
        </a>
        <a href="/u/13cba2dc6b23?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">
          {{ $user ->name }}
        </a>
        <p> 1k喜欢</p>
      </li>
      @endforeach
      <!--  -->
    </ul>

    <!--  -->
    <a href="{{ route('users.index') }}" target="_blank" class="find-more">查看全部作者 <i class="glyphicon glyphicon-menu-right"></i></a>
  </div>
</div>
