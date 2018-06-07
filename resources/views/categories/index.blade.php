@extends('layouts.app')

@section('content')
<div class="container recommend">
  <div class="row">
    @foreach($categories as $category)
    <div class="col-xs-3">
      <div class="collection-wrap">
        <a target="_blank" href="/c/e7d2d4045b36">
          <img class="avatar-collection img-thumbnail" src="//upload.jianshu.io/collections/images/75/22.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/180/h/180" alt="180">
          <h4 class="name">{{ $category ->name }}</h4>
          <p class="collection-description">{{ $category ->description }}</p>
        </a>
        @if(!$category -> categoryKeep(Auth::id()) -> exists())
        <a href="{{ route('categories.categoryKeep', $category) }}" class="btn follow-btn">关注</a>
        @else
        <a href="{{ route('categories.unCategoryKeep', $category) }}" class="btn follow-btn">取消关注</a>
        @endif
        <hr>
        <div class="count">
          <a target="_blank" href="/c/e7d2d4045b36">{{ $category ->article() ->count() }} 篇文章</a> · {{ count($category ->user()) }}人关注
        </div>
      </div>
    </div>
    @endforeach
    </div>
  </div>
</div>
@endsection
