@extends('layouts.app')

@section('content')
<div class="container index">
  <div class="row">
    <!--  -->
    <div class="col-xs-4 library">
      <div>
        <h4>
          <i class="glyphicon glyphicon-trash"></i> 回收站：
        </h4>
        <ul class="list-group">
          @if(!$topics ->isEmpty())
            @foreach($topics as $topic)
            <li class="list-group-item @if($topic ->id == $top[0] ->id) active @endif">
              <a href="{{ route('topics.recycle', $topic ->id) }}">{{ $topic ->name }}</a>
            </li>
            @endforeach
          @endif
        </ul>
      </div>
    </div>

    <!--  -->
    <div class="col-xs-8 main note topic">
      <div class="post">
        <!-- 文章信息 -->
        <div class="article">
          <!--  -->
          @if(!$topics ->isEmpty())
            <h3 class="title" style="padding-bottom: 15px; margin-bottom: 25px; border-bottom: 1px solid #f0f0f0;">{{ $top[0] ->name }}</h3>

            <div class="" style="padding-bottom: 15px; margin-bottom: 25px; border-bottom: 1px solid #f0f0f0;">
              <a class="edit" href="{{ route('topics.recover', $topic ->id) }}" class="edit">恢复文章</a>
              <a class="edit" href="{{ route('topics.delete', $topic ->id) }}" class="edit">彻底删除</a>
            </div>

            <!--  -->
            <div class="show-content">
              <div class="show-content-free">
                {!! $top[0] ->body !!}
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>


  </div>
</div>
@endsection
