@if(count($adverts) > 0)
<div class="banner section shadow welcome_side">
  <div class="section shadow auth-section">
    <div class="title">
      <span>招商合作</span>
    </div>
    <hr/>
    @foreach($adverts as $advert)
    <a href="{{ $advert ->link }}" alt="{{ $advert ->name }}">
      <div class="banner-image" style="background-image: url('{{ $advert ->cover }}'); background-size: cover;"></div>
    </a>
    @endforeach
  </div>
</div>
@endif
