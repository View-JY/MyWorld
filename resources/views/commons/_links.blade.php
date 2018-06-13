<div class="welcome_side welcome_side links">
  <div class="section shadow auth-section">
    <div class="title">
      <span>友情链接</span>
    </div>
    <hr/>
    <ul class="links-list">
      @foreach($friends as $key=>$value)
      <li>
        <a href="{{$value ->link}}" target="_blank" rel="nofollow" title="{{ $value ->name }}" style="padding: 3px;line-height: 40px;">
            <img src="{{ $value ->logo }}" style="width:150px; margin: 3px 0;">
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>
