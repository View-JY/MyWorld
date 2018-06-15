@if(count($notices) > 0)
<div class="welcome_side welcome_side links">
  <div class="section shadow auth-section">
    <div class="title">
      <span>系统消息</span>
    </div>
    <hr style="margin: 10px auto 10px;"/>
    <ul class="links-list">
      @foreach($notices as $notice)
      <li style="padding: 5px 5px 6px 5px; text-align: left;">
        <a href="/notices/{{ $notice ->id }}/edit" target="_blank" rel="nofollow" title="{{ $notice ->title }}" style="display: block;">
          {{ $notice ->title }}
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>
@endif
