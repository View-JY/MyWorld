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
        <a class="btn follow-btn"><i class="iconfont ic-follow"></i><span>关注</span></a>
        <hr>
        <div class="count">
          <a target="_blank" href="/c/e7d2d4045b36">44826篇文章</a> · 1636.0K人关注
        </div>
      </div>
    </div>
    @endforeach
    </div>
  </div>
</div>
@endsection
