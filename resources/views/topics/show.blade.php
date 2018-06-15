@extends('layouts.app')

@section('content')
<div class="container index">
  <div class="row">
    @include('commons._message')

    <!--  -->
    <div class="col-xs-8 main note topic">
      <div class="post">
        <!-- 文章信息 -->
        <div class="article">
          <h3>《{{ $topic ->work ->name }}》</h3>
          <!--  -->
          <h1 class="title" style="padding-bottom: 15px; margin-bottom: 25px; border-bottom: 1px solid #f0f0f0;">{{ $topic ->name }}</h1>

          @if(Auth::id() == $topic ->user_id)
          <div class="" style="padding-bottom: 15px; margin-bottom: 25px; border-bottom: 1px solid #f0f0f0;">
            <form class="" action="{{ route('topics.destroy', $topic ->id) }}" method="post" style="display: inline-block;">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="edit">删除文章</button>
            </form>
            <a class="edit" href="{{ route('topics.edit', $topic ->id) }}"  class="edit">编辑文章</a>
          </div>
          @endif

          <!--  -->
          <div class="show-content">
            <div class="show-content-free">
              {!! $topic ->body !!}
            </div>
          </div>
        </div>

        <div class="book-menu clearfix">
          <div class="menu-item">
              @if($prev_article)
              <a href="{{ route('topics.show', $prev_article) }}">
                <i class="glyphicon glyphicon-menu-left"></i> 上一篇
              </a>
              @else
              <a href="javascript:;">
                没有更多了
              </a>
              @endif
          </div>
          <div class="menu-item">
              <a href="javascript:;"></a>
          </div>
          <div class="menu-item" style="border-right: none;">
              @if($next_article)
              <a href="{{ route('topics.show', $next_article) }}">
                下一篇 <i class="glyphicon glyphicon-menu-right"></i>
              </a>
              @else
              <a href="javascript:;">
                没有更多了
              </a>
              @endif
          </div>
        </div>

      </div>
    </div>

    <!--  -->
    <div class="col-xs-4 library">
      <div style="">
        <h4><i class="glyphicon glyphicon-th-list"></i> 目录：</h4>

        <!--  -->
        <ul class="list-group">
          @foreach($topic ->work ->workTopic as $key => $workTopic)
          <li class="list-group-item @if($topic ->id == $workTopic ->id) active @endif">
            <a href="{{ route('topics.show', $workTopic) }}"><span>{{ $key + 1 }}.</span> {{ $workTopic -> name }}</a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>

  </div>
</div>
@endsection
