@extends('layouts.app')

@section('content')
<div class="container">
  <div class="tag-info-box">
    <div class="tag-info">
      <div class="title">{{ $tag ->tag_name }}</div>
      <div class="tag-meta">{{ $tag ->article ->count() }} 文章</div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <!--  -->
      <div class="list-container">
        <ul class="note-list">
          <!--  -->
          @foreach($tag ->article as $article)
          <li id="note-29418953" @if($article ->cover)class="have-img"@endif>
            <a class="wrap-img" href="{{ route('articles.show', $article) }}" target="_blank">
              <img class="img-blur-done" src="{{ $article ->cover }}" alt="120">
            </a>
            <div class="content">
              <a class="title" target="_blank" href="{{ route('articles.show', $article) }}">{{ $article ->title }}</a>
              <p class="abstract">
                {{ $article ->abstract }}
              </p>
              <div class="meta">
                <a class="nickname" target="_blank" href="{{ route('users.show', $article ->user) }}">{{ $article ->user ->name }}</a>
                <a target="_blank" href="{{ route('articles.show', $article) }}">
                  <i class="glyphicon glyphicon-comment"></i> {{ $article ->comment ->count() }}
                </a>
                <span><i class="glyphicon glyphicon-heart"></i> {{ $article ->articleZans ->count() }}</span>
              </div>
            </div>
          </li>
          @endforeach
          <!--  -->
        </ul>
      </div>
      <!--  -->
    </div>
  </div>
</div>
@endsection
