
@if(count($comments))
  @foreach($comments as $key => $comment)
  <div class="comment" style="margin-top: 15px;">
  <!-- 评论作者 -->
  <div class="author">
    <div class="v-tooltip-container" style="z-index: 0;">
      <div class="v-tooltip-content">
        <a href="/u/3427d92fe14d" target="_blank" class="avatar">
            @if(empty($comment ->user ->userinfo ->avatar))
            <img class="img-thumbnail" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=164802939,3427154249&fm=27&gp=0.jpg" alt="120">
            @else
            <img class="img-thumbnail" src="{{ $comment ->user ->userinfo ->avatar }}" alt="120">
            @endif
          </a>
         </div>
       </div>
      <div class="info" data-id="{{ $comment ->user ->id }}">
        <a href="/u/3427d92fe14d" target="_blank" class="name">{{ $comment ->user ->name }}</a>
        <div class="meta">
          <span>{{ $key + 1 }} 楼 · {{ $comment ->created_at }}</span>
         </div>
       </div>
     </div>
    <!-- 评论内容 -->
    <div class="comment-wrap">
      <p>{{ $comment ->body }}</p>
      <div class="tool-group">
        <!--  -->
        @if(!$comment -> commentZan(Auth::id()) -> exists())
        <a id="like-button-23823521" class="like-button" href="{{ route('comments.zan', $comment) }}">
          <i class="glyphicon glyphicon-thumbs-up"></i>
          <span>赞 ({{ $comment -> commentZan(Auth::id()) ->count() }})</span>
        </a>
        @else
        <a id="like-button-23823521" class="like-button" href="{{ route('comments.unzan', $comment) }}">
          <i class="glyphicon glyphicon-thumbs-up"></i>
          <span>取消赞 ({{ $comment -> commentZan(Auth::id()) ->count() }})</span>
        </a>
        @endif

        <!-- 举报评论 -->
        @if( Auth::id() == $comment ->user ->id )

        <a class="comment-delete pull-right" href="{{ route('comments.report', $comment) }}"><i class="  glyphicon glyphicon-remove-sign"></i> <span>举报</span></a>
        <!-- 删除评论 -->
        <form action="{{ route('comments.destroy', $comment) }}" method="post" class="pull-right" style="display: inline-block;">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="comment-delete" style="background: none; outline: none; border: none;"><i class="glyphicon glyphicon-trash"></i> <span>删除</span></button>
         </form>
       @endif
       </div>
     </div>
   </div>
  @endforeach
 @endif
