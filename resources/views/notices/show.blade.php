@extends('layouts.app')

@section('content')
<div class="container index">
  <div class="row">
    <!--  -->
    <div class="col-xs-8 main note topic">
      <h3>{{ $notice ->title }}</h3>
      <hr>
      <div>
        <p>{{ $notice ->content }}</p>
      </div>
    </div>

    <!--  -->
    <div class="col-xs-4 library">
      <div style="">
        <h4><i class="glyphicon glyphicon-th-list"></i> 系统通知：</h4>

        <!--  -->
        <ul class="list-group">
          @foreach($notices as $notice)
            <li class="list-group-item">
              <a href="/notices/{{$notice ->id}}/edit"> {{ $notice ->title }}</a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
