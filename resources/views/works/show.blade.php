@extends('layouts.app')

@section('content')
<div class="container collection work">
  <div class="row">
    <!--  -->
    <div class="col-xs-8 main">
      <!--  -->
      <div class="main-top">
        <a class="avatar-collection" href="/c/589b877cf4a7">
          <img class="img-thumbnail" src="{{ $work ->cover }}" alt="240">
        </a>

        @if(Auth::id() == $work ->user ->id)
        <a href="{{ route('topics.recycle') }}" class="btn btn-default following"><i class="glyphicon glyphicon-trash"></i> <span>回收站</span></a>

        <a href="{{ route('topics.write', $work) }}" class="btn btn-success following"><i class="glyphicon glyphicon-pencil"></i> <span>写文章</span></a>
        @endif

        <div class="title">
          <a class="name" href="/c/589b877cf4a7">{{ $work ->name }}</a>
        </div>
        <div class="info">
          共有 {{ count($work ->workTopic) }} 篇文章
        </div>
      </div>
      <!--  -->
      <ul class="trigger-menu">
        <li class="active">
          <a href="/c/589b877cf4a7?order_by=commented_at">
            <i class="glyphicon glyphicon-file"></i> 最新文章
          </a>
        </li>
      </ul>
      <!--  -->
      <ul class="note-list">
        <!--  -->
        @if(count($work ->workTopic) > 0)
          @foreach($work ->workTopic as $topic)
          <li id="{{ $topic ->id }}" data-note-id="{{ $topic ->id }}" class="have-img">
            <a class="wrap-img" href="{{ route('topics.show', $topic ->id) }}" target="_blank">
              <img class="img-blur-done img-thumbnail" src="{{ $topic ->cover }}" alt="120">
            </a>
            <div class="content">
              <a class="title" target="_blank" href="{{ route('topics.show', $topic ->id) }}">{{ $topic ->name }}</a>
              <p class="abstract">{!! $topic ->abstract !!}</p>
              <div class="meta">
                <a href="{{ route('works.show', $topic ->work) }}">《{{ $topic ->work ->name }}》</a>
                <span>{{ $topic ->updated_at }}</span>
              </div>
            </div>
          </li>
          @endforeach
        @else
          @include('commons._empty')
        @endif
      </ul>
    </div>

    <!--  -->
    <div class="col-xs-4 aside" style="background: none;">
      <div>
        <div>
          <!--  -->
          <p class="title">文集公告</p>
          <!--  -->
          <div class="description js-description">
            <p>{{ $work ->describe }}</p>
          </div>
          <!--  -->
          <div>
            <div>
              <p class="title">管理员</p>
              <ul class="list collection-editor">
                <li>
                  <a href="/u/606f73047662" target="_blank" class="avatar">
                    <img src="//upload.jianshu.io/users/upload_avatars/4743930/0579ea6b-8c13-4178-b122-314178aad51d?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                  </a>
                  <a href="/u/606f73047662" target="_blank" class="name">{{ $work ->user ->name }}</a>
                  <span class="tag">创建者</span>
                </li>
              </ul>
            </div>
          </div>
          <!--  -->
          @if(Auth::id() == $work ->user ->id)
          <div class="user-action">
            <a class="name" href="{{ route('works.edit', $work) }}">编辑文集</a>
            @if( $work ->workTopic ->count() == 0 )
            <form class="" action="{{ route('works.destroy', $work) }}" method="post" style="display: inline-block;">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="delete-href">删除文集</button>
            </form>
            @endif
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
