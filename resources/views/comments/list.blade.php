@foreach ($comments as $comment)
@if($comment ->parent_id == 0)
<div class="comments" data-user_id="{{ $comment ->user ->id }}" data-parent_id="0" data-article_id="{{ $comment ->article ->id }}" data-comment_id="{{ $comment ->id }}">
  <div>
    <div class="author">
      <div class="v-tooltip-container" style="z-index: 0;">
        <div class="v-tooltip-content">
          <a href="#" target="_blank" class="avatar">
            <img src="{{ $comment ->user ->userinfo ->avatar }}">
          </a>
        </div>
      </div>
      <div class="info">
        <a href="#" target="_blank" class="name">{{ $comment ->user ->name }}</a>
        <div class="meta">
          <span>{{ $comment ->created_at }}</span>
        </div>
      </div>
    </div>
    <div class="comment-wrap">
      <p>{{ $comment ->body }}</p>
      <div class="tool-group">
        <a class="like-button">
          <i class="glyphicon glyphicon-thumbs-up"></i>
          <span>赞</span>
        </a>
        <a class="js_sub_show" style="cursor: pointer;">
          <i class="glyphicon glyphicon-comment"></i> <span>回复</span>
        </a>
        <a class="report">
          <i class="glyphicon glyphicon-remove"></i>
          <span>举报</span>
        </a>
      </div>
    </div>
  </div>

  <div class="sub-comment-list">
      @foreach($comment ->replys as $reply)
      <div class="sub-comment">
        <p>
          <div class="v-tooltip-container" style="z-index: 0;">
            <div class="v-tooltip-content">
              <a href="#" target="_blank">{{ $reply ->user ->name }}</a>：
            </div>
          </div>
          <span>{{ $reply ->body }}</span>
        </p>
        <div class="sub-tool-group">
          <span>{{ $reply ->created_at }}</span>
          <a class="js_num_comment">
            <i class="iconfont ic-comment"></i>
            <span>回复</span>
          </a>
          <a class="subcomment-delete">
            <span>删除</span>
          </a>
        </div>
      </div>
      @endforeach

    <div>
      <form class="new-comment" style="display: none;">
        <textarea placeholder="写下你的评论..."></textarea>
        <div class="write-function-block">
          <a class="btn btn-send js_sub_send" data-user_id="{{ $comment ->user ->id }}" data-parent_id="{{ $comment ->id }}" data-article_id="{{ $article ->id }}" data-comment_id="{{ $comment ->id }}">发送</a>
          <a class="cancel">取消</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@endforeach
