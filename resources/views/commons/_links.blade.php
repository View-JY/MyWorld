@if(count($firendlinks) > 0)
<div class="welcome_side welcome_side links">
  <div class="section shadow auth-section">
    <div class="title">
      <span>友情链接</span>
    </div>
    <hr/>
    <ul class="links-list">
      @foreach($firendlinks as $firendlink)
      <li>
        <a href="{{ $firendlink ->link }}" target="_blank" rel="nofollow" title="{{ $firendlink ->name }}" style="padding: 3px;line-height: 40px;">
            <img src="{{ $firendlink ->cover }}" style="width:100%; margin: 3px 0;">
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>
@endif
