<div>
  <form action="{{ route('comments.store') }}" method="POST" accept-charset="UTF-8" class="new-comment">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="article_id" value="{{ $article ->id }}">

    <a class="avatar">
      @if(empty($article ->user ->userinfo ->avatar))
      <img class="img-thumbnail" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="120">
      @else
      <img class="img-thumbnail" src="{{ $article ->user ->userinfo ->avatar }}" alt="120">
      @endif
    </a>

    <textarea placeholder="快来分享你的想法吧！" name="body"></textarea>

    <div class="write-function-block clearfix">
      <button type="submit" class="btn btn-send">发送</button>
      <button type="reset" class="btn cancel">取消</button>
    </div>

  </form>
</div>
