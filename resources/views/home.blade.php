@extends('layouts.app')

@section('content')
<div class="container index">
  <div class="row">
    <!-- Left -->
    <div class="col-xs-8 main">
      <!-- 文章分类 -->
      <div class="recommend-collection">
        @foreach($categories as $category)
        <a class="collection" target="_blank" href="/c/b676c24f7d60?utm_medium=index-collections&amp;utm_source=desktop" alt="{{ $category ->description }}">
          <img src="//upload.jianshu.io/collections/images/494271/51164a1egd7b1a4a7c491_690.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/64/h/64" alt="64">
          <div class="name">{{ $category ->name }}</div>
        </a>
        @endforeach
        <a class="more-hot-collection" target="_blank" href="/recommendations/collections?utm_medium=index-collections&amp;utm_source=desktop">
              点击查看更多热门专题 >>
        </a>
      </div>
    </div>
    <!-- Right -->
    <div class="col-xs-3 aside">

    </div>
  </div>
</div>
@endsection
