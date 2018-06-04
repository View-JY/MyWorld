<div>
  <form action="{{ route('comments.store') }}" method="POST" accept-charset="UTF-8" class="new-comment">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="article_id" value="{{ $article ->id }}">

    <a class="avatar">
      <img src="//upload.jianshu.io/users/upload_avatars/4743930/0579ea6b-8c13-4178-b122-314178aad51d?imageMogr2/auto-orient/strip|imageView2/1/w/114/h/114" class="img-thumbnail">
    </a>

    <textarea placeholder="分享你的想法" name="body"></textarea>

    <div class="write-function-block clearfix">
      <button type="submit" class="btn btn-send">发送</button>
      <button type="reset" class="btn cancel">取消</button>
    </div>

  </form>
</div>
