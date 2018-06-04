<!--  -->
@if(count($comments))
@foreach($comments as $comment)
<div class="comment" style="margin-top: 15px;">
  <!-- 评论作者 -->
  <div class="author">
    <div class="v-tooltip-container" style="z-index: 0;">
      <div class="v-tooltip-content">
        <a href="/u/3427d92fe14d" target="_blank" class="avatar">
          <img src="//upload.jianshu.io/users/upload_avatars/9497245/75162f76-ea46-45ae-8fad-9332fd36ba4d.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/114/h/114">
        </a>
      </div>
    </div>
    <div class="info" data-id="{{ $comment ->user ->id }}">
      <a href="/u/3427d92fe14d" target="_blank" class="name">{{ $comment ->user ->name }}</a>
      <div class="meta">
        <span>11楼 · {{ $comment ->created_at }}</span>
      </div>
    </div>
  </div>
  <!-- 评论内容 -->
  <div class="comment-wrap">
    <p>{{ $comment ->body }}</p>
    <div class="tool-group">
      <a id="like-button-23823521" class="like-button">
        <i class="glyphicon glyphicon-thumbs-up"></i>
        <span>28人赞</span>
      </a>
      <a class="">
        <i class="glyphicon glyphicon-comment"></i>
        <span>回复</span>
      </a>
      <a class="report">
        <i class="glyphicon glyphicon-fire"></i>
        <span>举报</span>
      </a>
    </div>
  </div>
</div>
@endforeach
@endif
