@extends('layouts.app')

@section('content')
<div class="container recommend">
  <div class="row">
    @foreach($categories as $category)
    <div class="col-xs-3">
      <div class="collection-wrap">
        <a target="_blank" href="{{ route('categories.show', $category) }}">
          <img class="avatar-collection img-thumbnail" src="{{ $category ->cover }}" alt="180">
          <h4 class="name">{{ $category ->name }}</h4>
          <p class="collection-description" style="min-height: 78px;">{{ $category ->description }}</p>
        </a>
        @if(Auth::check())
          @if(!$category -> categoryKeep(Auth::id()) -> exists())
          <a href="{{ route('categories.categoryKeep', $category) }}" class="btn follow-btn">关注</a>
          @else
          <a href="{{ route('categories.unCategoryKeep', $category) }}" class="btn follow-btn">取消关注</a>
          @endif
        @endif
        <hr>
        <div class="count">
          <a target="_blank" href="{{ route('categories.show', $category) }}">{{ $category ->article() ->count() }} 篇文章</a> · {{ $category ->categoryKeeps ->count() }} 人关注
        </div>
      </div>
    </div>
    @endforeach
    </div>

    {{ $categories ->render() }}
  </div>
</div>
@endsection
