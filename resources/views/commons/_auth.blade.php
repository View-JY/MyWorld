<div class="welcome_side welcome_side">
  <div class="section shadow auth-section">
    <div class="title">
      <span>View - 注册</span>
    </div>
    <small class="ticket">带你发现不一样的世界</small>
    <hr/>
    <!--  -->
    <form class="" action="{{ route('register') }}" method="post">
      {{ csrf_field() }}
      <div class="input-group">
        <div class="input-box">
          <input name="name" maxlength="20" placeholder="用户名" class="input">
        </div>
        <div class="input-box">
          <input name="email" placeholder="email" class="input">
        </div>
        <div class="input-box">
          <input name="password" type="password" placeholder="密码（不少于 6 位）" class="input">
        </div>
        <div class="input-box">
          <input name="password" type="password" placeholder="重复密码" class="input">
        </div>
      </div>
      <button class="btn btn-info">立即注册</button>
    </form>
  </div>
</div>
