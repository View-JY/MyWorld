<div class="welcome_side welcome_side dynamic">
  <div class="section shadow auth-section">
    <div class="title">
      <span>随便吐槽点什么吧</span>
    </div>
    <hr/>
    <form class="" action="index.html" method="post">
      {{ csrf_field() }}
      <input type="text" name="dynamic" placeholder="全世界都能看到你说的,请谨慎发言" required="required">
      <button type="submit" class="btn btn-info">点击发表动弹</button>
    </form>

    <ul class="dynamic-list">
      <!--  -->
      <li class="dynamic-item">
        <a class="dynamic-img">
          <img class="img-circle img-thumbnail" src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96" alt="咋了猪咋了"/>
        </a>
        <div class="dynamic-meta">
          <a class="UserLink-link" target="_blank" href="">咋了猪咋了：</a>
        </div>
        <div class="dynamic-content">
          <p>问这种问题的一般是人都认不全的人。</p>
        </div>
        <div class="dynamic-option">
          <span><i class="glyphicon glyphicon-time"></i> 2018-3-21</span>
        </div>
      </li>
      <!--  -->
      <li class="dynamic-item">
        <a class="dynamic-img">
          <img class="img-circle img-thumbnail" src="//upload.jianshu.io/users/upload_avatars/4802366/4f86b75d-b61b-4126-8be4-87a151c9cd28.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96" alt="咋了猪咋了"/>
        </a>
        <div class="dynamic-meta">
          <a class="UserLink-link" target="_blank" href="">咋了猪咋了：</a>
        </div>
        <div class="dynamic-content">
          <p>问这种问题的一般是人都认不全的人。</p>
        </div>
        <div class="dynamic-option">
          <span><i class="glyphicon glyphicon-time"></i> 2018-3-21</span>
        </div>
      </li>
      <!--  -->
    </ul>
  </div>
</div>
