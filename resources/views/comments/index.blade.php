<div>
  <form class="new-comment">
    <!-- 文章ID -->
    <input type="hidden" name="article_id" value="{{ $article ->id }}">

    <a class="avatar">
      @if(empty($article ->user ->userinfo ->avatar))
        <img class="img-thumbnail" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="120">
      @else
        <img class="img-thumbnail" src="{{ $article ->user ->userinfo ->avatar }}" alt="120">
      @endif
    </a>

    <textarea placeholder="快来分享你的想法吧！" name="body" class="js_top_text"></textarea>

    <div class="write-function-block clearfix">
      <a class="btn btn-send js_top_send" data-user_id="{{ $article ->user ->id }}" data-article_id="{{ $article ->id }}" data-parent_id="0">发送</a>
      <a class="btn cancel">取消</a>
    </div>

  </form>
</div>
